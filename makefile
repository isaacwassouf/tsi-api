dev:
	php artisan serve

clear-cache:
	rm -r ./bootstrap/cache/* \
	&& php artisan config:clear \
	&& php artisan cache:clear \
	&& php artisan route:clear \
	&& php artisan view:cache \
	&& php artisan view:cache \
	&& php artisan clear-compiled

optimize:
	php artisan optimize
pint:
	./vendor/bin/pint

migrate:
	php artisan migrate

ide-models:
	echo "yes" | php artisan ide-helper:models

create-migration:
	read -p "Enter migration name: " name; \
	php artisan make:migration $$name
