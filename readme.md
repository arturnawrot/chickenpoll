
## Installation

- composer install
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
