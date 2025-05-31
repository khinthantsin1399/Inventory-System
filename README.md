# Inventory-System

## Installation

Please Install the required dependency using this command.

    composer install

After that, copy .env.example file from your project directory and create .env file using first command described below. Then generate the **APP_KEY** value for your .env file using second command.

    cp .env.example .env
    php artisan key:generate
 
For database configuration, please update the below keys from your .env file with your current database credentials.
  
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=inventory_db
    DB_USERNAME=
    DB_PASSWORD=

Once you finish that, please run below commands for clearing cache, migration and creating a symlink to your storage folder.

    php artisan config:cache
    php artisan migrate --seed
    php artisan storage:link
    
    
All the required steps have been done, and you can now finally run the app using this command.

    php artisan serve

 - For default user, please use the  `admin@mail.com` and password `123456`










