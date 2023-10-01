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
