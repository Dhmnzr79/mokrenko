<?php
/**
 * Safe SVG uploads (admin only)
 *
 * WordPress blocks SVG by default for security reasons.
 * This file enables SVG uploads only for administrators and sanitizes SVG content on upload.
 */

/**
 * Allow SVG mime type only for administrators.
 */
add_filter('upload_mimes', function ($mimes) {
    if (!current_user_can('manage_options')) {
        return $mimes;
    }
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/**
 * Fix WP filetype detection for SVG.
 */
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if ($ext !== 'svg') {
        return $data;
    }

    if (!current_user_can('manage_options')) {
        return $data;
    }

    $data['ext']  = 'svg';
    $data['type'] = 'image/svg+xml';
    return $data;
}, 10, 4);

/**
 * Sanitize SVG before it gets moved into uploads.
 */
add_filter('wp_handle_upload_prefilter', function ($file) {
    if (!current_user_can('manage_options')) {
        return $file;
    }

    $name = isset($file['name']) ? (string)$file['name'] : '';
    $tmp  = isset($file['tmp_name']) ? (string)$file['tmp_name'] : '';

    if ($name === '' || $tmp === '' || !file_exists($tmp)) {
        return $file;
    }

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if ($ext !== 'svg') {
        return $file;
    }

    $svg = file_get_contents($tmp);
    if ($svg === false || $svg === '') {
        $file['error'] = __('Не удалось прочитать SVG файл.', 'mokrenko');
        return $file;
    }

    $clean = mokrenko_sanitize_svg($svg);
    if ($clean === null) {
        $file['error'] = __('SVG файл содержит неподдерживаемые/опасные элементы.', 'mokrenko');
        return $file;
    }

    file_put_contents($tmp, $clean);
    return $file;
});

/**
 * Very small SVG sanitizer (no dependencies).
 *
 * Returns sanitized SVG string, or null on parse failure.
 */
function mokrenko_sanitize_svg(string $svg): ?string {
    // Strip BOM / weird leading chars
    $svg = preg_replace('/^\xEF\xBB\xBF/', '', $svg);

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();

    // Avoid network access and avoid expanding entities
    $loaded = $dom->loadXML($svg, LIBXML_NONET);
    if (!$loaded) {
        return null;
    }

    $root = $dom->documentElement;
    if (!$root || strtolower($root->tagName) !== 'svg') {
        return null;
    }

    // Remove dangerous elements
    $danger_tags = ['script', 'foreignobject', 'iframe', 'object', 'embed'];
    foreach ($danger_tags as $tag) {
        $nodes = $dom->getElementsByTagName($tag);
        // Live NodeList: iterate backwards
        for ($i = $nodes->length - 1; $i >= 0; $i--) {
            $node = $nodes->item($i);
            if ($node && $node->parentNode) {
                $node->parentNode->removeChild($node);
            }
        }
    }

    // Remove dangerous attributes (event handlers, javascript: hrefs)
    $xpath = new DOMXPath($dom);
    foreach ($xpath->query('//@*') as $attr) {
        /** @var DOMAttr $attr */
        $name = strtolower($attr->name);
        $value = (string)$attr->value;

        // Event handler attributes: onload, onclick, ...
        if (strpos($name, 'on') === 0) {
            $attr->ownerElement?->removeAttributeNode($attr);
            continue;
        }

        // href / xlink:href with javascript:
        if ($name === 'href' || $name === 'xlink:href') {
            if (preg_match('/^\s*javascript:/i', $value)) {
                $attr->ownerElement?->removeAttributeNode($attr);
            }
            continue;
        }

        // style attribute: block obvious script vectors
        if ($name === 'style') {
            if (preg_match('/javascript:|data\s*:\s*text\/html|expression\s*\(/i', $value)) {
                $attr->ownerElement?->removeAttributeNode($attr);
            }
        }
    }

    // Output only the SVG element (no XML declaration)
    $out = $dom->saveXML($dom->documentElement);
    return is_string($out) && $out !== '' ? $out : null;
}




