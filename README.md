# BelgianPHP Uri

```
$ composer require belgian/uri
```

.htaccess:
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?uri=$1
```

