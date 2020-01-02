
## Installation

- composer install
- sudo chown -R www-data:www-data /path/to/your/laravel/root/directory
- sudo find /path/to/your/laravel/root/directory -type f -exec chmod 644 {} \;    
- sudo find /path/to/your/laravel/root/directory -type d -exec chmod 755 {} \;
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

If you get ``proc_open(): fork failed - Cannot allocate memory during composer`` installation execute: 
- sudo /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024 && sudo /sbin/mkswap /var/swap.1 && sudo /sbin/swapon /var/swap.1
