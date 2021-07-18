install: file-permission dependency-install generate-app-key migration optimize
install-dev: file-permission dependency-install generate-app-key migration optimize

file-permission:
	chmod -R 775 storage
	chmod 775 bootstrap/cache/

migration:
	php artisan migrate:reset
	php artisan migrate --seed

generate-app-key:
	php artisan key:generate

dependency-install:
	composer update

optimize:
	php artisan route:cache
	php artisan cache:clear
	php artisan view:clear
	php artisan route:clear
	php artisan config:cache
	php artisan config:clear

test:
	php artisan config:clear
	php artisan test