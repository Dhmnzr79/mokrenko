# Кеширование статики (Cache-Control)

Заголовки задаются на сервере (Apache/Nginx). Тема сама их не отдаёт.

## Apache (.htaccess или конфиг виртуального хоста)

Добавить **после** блока mod_expires (если он уже есть) или отдельно:

```apache
<IfModule mod_headers.c>
  # Шрифты — 1 год (версия в URL при смене темы)
  <FilesMatch "\.(woff2?|ttf|otf|eot)$">
    Header set Cache-Control "public, max-age=31536000, immutable"
  </FilesMatch>
  # CSS и JS темы — 1 месяц (у WordPress в URL есть ver=)
  <FilesMatch "\.(css|js)$">
    Header set Cache-Control "public, max-age=2592000, immutable"
  </FilesMatch>
</IfModule>
```

Если используете только `mod_expires` (без Header):

```apache
ExpiresByType font/woff2 "access plus 1 year"
ExpiresByType font/woff  "access plus 1 year"
ExpiresByType text/css   "access plus 1 month"
ExpiresByType application/javascript "access plus 1 month"
```

## Nginx

В блоке `server` (или `location` для статики):

```nginx
location ~* \.(woff2?|ttf|otf|eot)$ {
  expires 1y;
  add_header Cache-Control "public, immutable";
}
location ~* \.(css|js)$ {
  expires 30d;
  add_header Cache-Control "public, immutable";
}
```

## Рекомендации

- **max-age=31536000** (1 год) — для шрифтов и редко меняющихся ресурсов с версией в URL.
- **immutable** — браузер не будет проверять актуальность до истечения max-age (меньше запросов).
- Для CSS/JS с `?ver=...` в WordPress можно ставить 1 месяц или 1 год; при обновлении темы версия меняется и браузер скачает новый файл.
