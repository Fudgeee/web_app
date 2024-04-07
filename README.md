# Web app

A web application with a list of European countries and the current exchange rates of their currencies.

## Installation

1. Clone this repository:

   ```bash
   git clone https://github.com/Fudgeee/web_app.git

2. Install dependencies using Composer:

   ```bash
   composer install

3. Create database

   ```bash
   mysql -u your_username -p
   CREATE DATABASE your_database_name;

4. Configure the .env file 

5. Make the migrations:

   ```bash
   php artisan key:generate
   php artisan migrate

6. Fill the database

   ```bash
   php artisan countries:populate
   php artisan currency:update

7. Start the web server:

   ```bash
   php artisan serve
