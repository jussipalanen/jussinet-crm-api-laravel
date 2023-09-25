<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Introduction

The personal and versatile CRM web application is made with the Laravel Framework. Users can log into the CRM system, and create new products, categories, customers, etc. This contains the API interface, where the user can fetch the data from the database with their own credentials.

## Requirements
- PHP 8.x
- Composer
- MariaDB

## How to use
- Create the new database, and after that start configure your database connection in your `.env` file, and start the server by command line:
```
php artisan serve
```
- Go to your browser and remember, it depends on what port you are using on your server.
```
http://localhost:8081/
```

- Fill in your email address and password on the login form.

## API

### Get the token (Method: Post)
Body (form-data): 
```
email: your@email.com
password: your_password
```
Request URL:
```
http://<your-hostname>/api/token
```

### Get the products (Method: Post)

Headers: 
```
Authorization: <your_bearer_token>
```
Request URL:
```
http://<your-hostname>/api/products/
```

## Introduction
Demo: https://jussinet.dev.jussialanen.com
