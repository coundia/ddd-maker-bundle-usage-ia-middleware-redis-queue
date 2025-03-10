#!/bin/bash

# Configuration
PROJECT_NAME="ddd_demo"
DOMAIN="groupe2cs.com"
DB_NAME="${PROJECT_NAME}_db"
DB_USER="${PROJECT_NAME}_user"
DB_PASS="password_secure"
PROJECT_DIR="/var/www/$PROJECT_NAME"
GIT_REPO="git@github.com:coundia/ddd-maker-bundle-usage-demo.git"

echo "🛠️ Déploiement de Symfony..."
sudo chown -R $USER:$USER /var/www/$PROJECT_NAME

git pull origin main
sudo php bin/console doctrine:migrations:migrate
sudo php bin/console cache:clear --env=prod
sudo php bin/console cache:warmup --env=prod

sudo chown -R www-data:www-data /var/www/$PROJECT_NAME
sudo chmod -R 775 /var/www/$PROJECT_NAME/var /var/www/$PROJECT_NAME/public


sudo systemctl restart php8.3-fpm
sudo systemctl restart nginx 

echo "✅ Configuration terminée avec succès !"
echo "🌍 Accédez à http://$DOMAIN pour voir votre site $PROJECT_NAME."