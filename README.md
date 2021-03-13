# Installation Admin Seven


### Preparation
To install this core, you should familiar with Laravel, environment are below :
```
*   PHP >-= 7
*   MySQL Database >= 5
*   Compsoer
```

After get source, add `.env` file  :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=admin_seven
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```



### Installation

Run in console :

1. Install composer
>  `composer install`

2. Dump vendor package, migration and seeder
> `composer dump-autoload -o`

3. Run migration
> `php artisan migrate`

4. Run Seeder
> `php artisan db:seed`

5. Make sure your table into database has been created, and the data are imported
6. Then run your php artisan 
> `php artisan serve`

### Documentation

Check documentation at [Admin Seven Documentation]('http://admin-seven.monsterzgroup.com/')
