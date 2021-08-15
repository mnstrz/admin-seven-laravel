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

2. Run command
> `php artisan install:first`

3. Make sure your table into database has been created, and the data are imported
4. Then run your php artisan 
> `php artisan serve`

### Documentation

Check documentation at http://admin-seven.monsterzgroup.com
