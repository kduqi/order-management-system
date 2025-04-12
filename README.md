# Order Management System

A simple Order Management System built with Laravel 12, designed to manage customers, products, and orders through a RESTful API.

## Features

- RESTful API for:
  - **Product Management** (`/api/products`)
  - **Customer Management** (`/api/customers`)
  - **Order Management** (`/api/orders`)
- Authentication using **Laravel Sanctum**
- API Documentation via **Laravel Swagger**

## Tech Stack

- **Laravel 12**
- **Laravel Sanctum** (for authentication)
- **Laravel Swagger** (for API documentation)
- **MySQL**
- **PHPUnit** (for testing)

## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/kduqi/order-management-system
   cd order-management-system
   ```

2. **Copy the environment configuration**
   ```bash
   cp .env.example .env
   ```

3. **Install the dependencies**
   ```bash
   composer install
   ```

4. **Start the Docker container**
   ```bash
   ./vendor/bin/sail up -d
   ```

5. **Generate the application key**
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

6. **Run migrations and seed the database**
   ```bash
   ./vendor/bin/sail artisan migrate
   ./vendor/bin/sail artisan db:seed
   ```

7. **Access the application**
   Open the API documentation at:  
   [http://localhost/api/documentation](http://localhost/api/documentation)