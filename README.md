<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## About Project
    There is an application is for a fruit shop.  Users has to login or register. Application has one admin role user wich was seeded. With admin role he see's all users, all orders and has permission to filter orders or users by name. Also he can upload an images. User only see's list of products which he can buy. User not allowed to see others orders. 

Functionality:
   Login or registr user. Admin can create new products and edit them or delete, see all users orders. Also upload an image. 
    
## Instalation


This project was made on Laravel 8 version:

Alternative installation is possible without local dependencies relying on Docker.

Clone the repository:

    git clone https://github.com/NRimantas/fruit_shop.git

Switch to the repo folder:

    cd fruit_shop

Install all the dependencies using composer:

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (Make sure that have database named "fruit_shop"):

    php artisan migrate

Start the local development server

php artisan serve You can now access the server at http://localhost:8000

TL;DR command list:

    git clone https://github.com/NRimantas/fruit_shop.git
    cd cd students_projects
    composer install
    Make sure you set the correct database connection information before running the migrations Environment variables
    php artisan migrate
    php artisan serve



