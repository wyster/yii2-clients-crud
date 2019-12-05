#!/bin/bash

if [ $COMPOSER_INSTALL == "1" ]; then
    composer global require hirak/prestissimo
    composer install
fi

chown www-data:www-data runtime
chmod 0755 runtime

chown www-data:www-data web/assets
chmod 0755 web/assets

mkdir -p web/uploads
chown www-data:www-data web/uploads
chmod 0755 web/uploads

chmod +x yii
./yii migrate --interactive=0

docker-php-entrypoint php-fpm
