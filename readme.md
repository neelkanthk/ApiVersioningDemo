# Api Versioning Demo

Blog: https://www.datatype.in/restful-api-versioning-using-inheritance

### Setup

NOTE: This code requires PHP >= 7.1.3

Install the dependencies and devDependencies and start the server.

```sh
$ git clone https://github.com/neelkanthk/ApiVersioningDemo.git
$ cd ApiVersioningDemo
$ composer install
$ cp .env.example .env
```

Edit the .env file and change the following MySQL connection variables:

```sh
DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT=3306\
DB_DATABASE=your_mysql_db_name\
DB_USERNAME=your_mysql_username\
DB_PASSWORD=your_mysql_password
```

Create a database:
```sh
mysql> CREATE DATABASE your_mysql_db_name
```
Create required tables
```sh
$ php artisan migrate
```
Run data seeder
```sh
$ php artisan db:seed --class=SongsTableSeeder
```
Launch the application
```sh
$ php artisan serve
```
License
----

MIT