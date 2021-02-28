install: file-permission dependency-install generate-app-key migration install-assets assets-production optimize
install-dev: file-permission dependency-install generate-app-key migration install-assets assets-dev optimize

file-permission:
	chmod -R 777 storage
	chmod 775 bootstrap/cache/

migration:
	php artisan migrate:reset
	php artisan migrate --seed

generate-app-key:
	php artisan key:generate

dependency-install:
	composer install

install-assets:
	npm install

assets-production:
	npm run prod

assets-dev:
	npm run dev

optimize:
	php artisan route:cache
	php artisan cache:clear
	php artisan view:clear
	php artisan route:clear
	php artisan config:cache
	php artisan config:clear 

random-avatar:
	php artisan avatar:random