# Laravel Task Management Application

This is a simple task management application built with Laravel and running on Docker using Laravel Sail. The application allows users to create, manage, and complete tasks.

## Features
- Task Creation
- Task Management
- Mark Tasks as Completed
- API for Task Management

## Prerequisites
- Docker
- Docker Compose
- Composer

## Installation

### 1. Clone the Repository
```bash
git clone git@github.com:kwadejeffrey/Laravel-Jazz.git
cd Laravel-Jazz


# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install


#Copy Env file
cp .env.example .env


#Update these variables
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:generated-key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=sail
DB_PASSWORD=password

#Start application
./vendor/bin/sail up -d

#Run migration 
./vendor/bin/sail artisan migrate

