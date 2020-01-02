
## Installation

- sudo rm composer.lock
- composer install
- sudo chown -R www-data:www-data /path/to/your/laravel/root/directory
- sudo chown -R www-data.www-data /var/www/travel_list/storage
- sudo chown -R www-data.www-data /var/www/travel_list/bootstrap/cache
- sudo chgrp -R www-data storage bootstrap/cache
- sudo chmod -R ug+rwx storage bootstrap/cache
- npm run prod
- sudo apt-get redis && sudo apt-get redis-server
- npm install --save socket.io-client
- laravel-echo-server init
- laravel-echo-server install
- php artisan queue:listen --tries=1
- crontab -e * * * * * * cd /var/www/polls && php artisan schedule:run >> /dev/null 2>&1
- php artisan migrate --seed
- php artisan wink:install
- Create two wink posts with the following slugs: privacy-policy, terms-of-use, contact

If something goes wrong try: php artisan optimize

If you get ``proc_open(): fork failed - Cannot allocate memory`` during composer installation execute: 
- sudo /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024 && sudo /sbin/mkswap /var/swap.1 && sudo /sbin/swapon /var/swap.1

## Nginx configuration

HTTP
``
server {
    listen 80;
    server_name server_domain_or_IP;
    root /var/www/travel_list/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location /socket.io {
            proxy_pass http://localhost:6001; #could be localhost if Echo and NginX are on the same box
            proxy_http_version 1.1;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "Upgrade";
        }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
``
HTTPS
``
server {
        listen 443 ssl;
ssl_certificate /etc/letsencrypt/live/chickenpoll.com/fullchain.pem;

ssl_certificate_key /etc/letsencrypt/live/chickenpoll.com/privkey.pem; #
include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
        server_name www.chickenpoll.com;
        return 301 https://chickenpoll.com$request_uri;
}
server {
    server_name chickenpoll.com;
    root /var/www/polls/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
location /socket.io {
            proxy_pass http://localhost:6001; #could be localhost if Echo and NginX are on the same box
            proxy_http_version 1.1;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "Upgrade";
        }
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/chickenpoll.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/chickenpoll.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot


}
server {
    if ($host = www.chickenpoll.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    if ($host = chickenpoll.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    listen 80;
    server_name www.chickenpoll.com chickenpoll.com;
    return 404; # managed by Certbot
}

``
