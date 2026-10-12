# Contact Manager (Laravel)

A contact manager built with **Laravel 5.7** and **MySQL**, with separate **user** and **admin** areas.

This is a **training project**. I built it for Laravel workshops to demonstrate authentication, resource controllers, middleware, migrations and seeders, file uploads, and deploying a Laravel app to an Ubuntu server. It is not a production application.

## Features

- User registration and login (Laravel auth scaffolding)
- Personal dashboard
- Full CRUD for contacts (Laravel resource controller), including image upload
- Separate admin login (`/admin/login`) protected by a custom `isAdmin` middleware
- Admin area to list users and activate or deactivate them
- Database migrations and seeders
- CKEditor integration (`unisharp/laravel-ckeditor`)

## Tech stack

- PHP 7.1.3+
- Laravel 5.7
- MySQL
- Composer
- Laravel Mix (webpack) for front-end assets
- Nginx on Ubuntu (deployment guide below)

## Prerequisites

- PHP 7.1.3 or higher with the usual Laravel extensions
- [Composer](https://getcomposer.org/)
- MySQL

## Running locally

1. Clone the repo:

   ```bash
   git clone https://github.com/veliyat/contact-manager-laravel.git
   cd contact-manager-laravel
   ```

2. Create an empty MySQL database.

3. Copy the environment file and set your `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`:

   ```bash
   cp .env.example .env
   ```

4. Install dependencies and set up the app:

   ```bash
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   php artisan serve
   ```

5. Open http://127.0.0.1:8000. The root URL redirects to the login page.

Admin login is at `/admin/login`. Check `database/seeds` for the seeded admin account.

## Routes at a glance

| Area | URI | Notes |
|---|---|---|
| Auth | `/login`, `/register`, ... | Laravel `Auth::routes()` |
| User | `/dashboard` | User dashboard |
| User | `/contacts` | Resource routes (index, create, store, show, edit, update, destroy) |
| Admin | `/admin/login`, `/admin/logout` | Separate admin authentication |
| Admin | `/admin/dashboard`, `/admin/users` | Protected by `isAdmin` middleware |
| Admin | `/admin/users/activate/{id}`, `/admin/users/deactivate/{id}` | Enable or disable a user |

## Deploying to an Ubuntu server (Nginx + MySQL + PHP)

A summary of the approach used in the workshop. Adjust the PHP version and paths for your server.

1. **Install packages:** Nginx, MySQL, PHP (with `fpm`, `mysql`, `mbstring`, `xml`, `zip`, `gd` extensions) and Composer.
2. **Point Nginx at the app:** set the server `root` to `/var/www/app/public` and pass PHP requests to PHP-FPM.
3. **Create a bare Git repo on the server** with a `post-receive` hook that checks the code out into `/var/www/app`:

   ```bash
   git --work-tree=/var/www/app --git-dir=/var/repo/app.git checkout -f
   ```

4. **Add the server as a remote and push** from your machine:

   ```bash
   git remote add production ssh://<user>@<server>/var/repo/app.git
   git push production master
   ```

5. **On the server**, inside `/var/www/app`:

   ```bash
   composer install --no-dev
   cp .env.example .env        # then edit with production values
   php artisan key:generate
   php artisan config:cache
   php artisan migrate --force
   php artisan storage:link
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache
   ```

**Security notes:** use a dedicated deploy user rather than root, grant the MySQL user privileges only on the app's database, and keep `.env` out of version control.

## Status and limitations

- Built on Laravel 5.7 and PHP 7.1, both end-of-life. Fine for learning, not for deployment as is.
- The deployment guide targets PHP 7.1; use a supported PHP version for any real setup.

## Author

Ravi Veliyat: [GitHub](https://github.com/veliyat) · [YouTube](https://www.youtube.com/raviveliyat)
