echo "pulling change from github"
sudo git stash
sudo GIT_SSH_COMMAND='ssh -i /home/ubuntu/.ssh/id_rsa' git pull origin master

echo "installing dependancy"
composer install

echo "Clear and cache configurations"
php artisan config:clear
php artisan config:cache

echo "Clear and cache routes"
php artisan route:clear
php artisan route:cache

echo "Clear and cache views"
php artisan view:clear
php artisan view:cache

echo "restarting apache2 server"
sudo systemctl restart apache2