# Create new Symfony project
symfony new symfony-ddd-starter --webapp

# Install  bundles and libraries
```
composer require symfony/maker-bundle --dev
composer require doctrine/doctrine-fixtures-bundle --dev
composer require zenstruck/foundry --dev
composer require phpunit/phpunit --dev
composer require foundry orm-fixtures --dev 
composer require  dama/doctrine-test-bundle --dev

composer require lexik/jwt-authentication-bundle
composer require symfony/validator
composer require nelmio/api-doc-bundle
composer require symfony/serializer
composer require twig asset
composer require symfony/mailer
composer require symfony/messenger
composer require ramsey/uuid
composer require symfony/messenger symfony/redis-messenger
composer require symfony/cache-contracts
composer require symfony/security-bundle
composer require symfony/orm-pack

# install ext php-redis, sur mac

pecl uninstall redis
pecl install redis
brew services restart php

composer require symfony/http-client
composer require symfony/messenger
composer require symfony/mercure
composer require symfony/redis-messenger  

mkdir -p config/jwt
openssl genrsa -aes256 -passout pass:your_passphrase -out config/jwt/private.pem 4096
openssl rsa -pubout -passin pass:your_passphrase -in config/jwt/private.pem -out config/jwt/public.pem

```
# Api doc

http://127.0.0.1:8000/api/docs

### Run tests

```
php bin/phpunit
```