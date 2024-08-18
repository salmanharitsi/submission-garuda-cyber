<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Project Overview

This project is developed as part of a test assignment for the MSIB program by PT. Garuda Cyber Indonesia. The project focuses on creating a referral program where users can earn points for referring new users. Below are the details of the project.

## Referral Program API

This project is a backend API service for managing a referral system, built using Laravel 11. The API provides functionalities for user registration, referral tracking, and points management.

### Features

- **User Registration**: Allows new users to register using a referral code.
- **Referral Tracking**: Tracks referrals and associates users with their referrers.
- **Points Management**:
  - Users receive 50 points for every new user that registers using their referral code.
  - The referrer also receives 50 points when a new user registers using their referral code.
- **Role & Permission Management**: Integrated with Laravel Spatie to manage user roles and permissions.
- **Server-Side Rendering**: Uses Laravel Livewire to build dynamic components.

### Technologies

- **Framework**: Laravel 11
- **Database**: MySQL (with Laravel migrations)
- **Authentication**: Token-based authentication
- **Role Management**: Laravel Spatie for roles and permissions
- **Livewire**: For server-side rendering components

### How to Run

1. Clone the repository.
2. Navigate to the project directory.
3. Install dependencies:
    ```bash
    composer install
    ```
4. Setup the database:
    ```bash
    php artisan migrate
    ```
5. Setup the Roles data seed first:
    ```bash
    php artisan db:seed --class=RolesSeeder
    ```
6. Setup the default admin account seed:
    ```bash
    php artisan db:seed --class=AdminSeeder
    ```
7. Run the development server:
    ```bash
    php artisan serve
    ```
7. Run the UI from node:
    ```bash
    npm run dev
    ```

Feel free to adjust the content or add more details as needed.


