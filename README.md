## Web app

A web application with a list of European countries and the current exchange rates of their currencies.

1. mysql -u your_username -p
2. CREATE DATABASE your_database_name;
3. .env nastavit 
    DB_DATABASE=web_app
    DB_USERNAME=root
    DB_PASSWORD=
4. php artisan migrate
5. php artisan countries:populate


