# RehabCare — Peaceful Home Management System 

A working starter rehabilitation management system for local testing and iterative refinement.

## Stack

- Laravel 13
- PHP 8.3+
- MySQL 8.4.x
- Laravel Herd on Windows
- VS Code
- Blade
- Bootstrap 5 via CDN
- MySQL migrations + Eloquent

Laravel 13 requires PHP >= 8.3. Herd on Windows provides PHP, Nginx, Composer, Laravel and related CLI tools.

## 1. Create the database

In MySQL/phpMyAdmin create:

```sql
CREATE DATABASE rehabcare CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 2. Put the project in Herd

Recommended:

```text
C:\Users\<YOUR-WINDOWS-USER>\Herd\rehabcare
```

Herd should expose it as:

```text
http://rehabcare.test
```

## 3. Install dependencies

Open PowerShell in the project:

```powershell
composer install
```

If PowerShell blocks npm.ps1, this MVP does NOT require npm for the UI because Bootstrap is loaded from CDN.

## 4. Configure environment

```powershell
copy .env.example .env
php artisan key:generate
```

Make sure `.env` contains:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rehabcare
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the username/password to match your MySQL installation.

## 5. Create the tables and demo data

```powershell
php artisan migrate --seed
```

## 6. Open the application

With Herd running:

```text
http://rehabcare.test
```

Or:

```powershell
php artisan serve
```

and open:

```text
http://127.0.0.1:8000
```

## Demo accounts

### Administrator
Email: admin@rehabcare.test
Password: test@1234

### Reception
Email: reception@rehabcare.test
Password: test@1234

### Clinical
Email: clinical@rehabcare.test
Password: test@1234

### Patient
Create a patient account using the public registration page.

## What currently works

### Public
- Landing page
- Services
- Service details
- Public reservation form
- Reservation reference
- Responsive Bootstrap UI

### Authentication
- Staff login
- Patient registration/login
- Logout
- Role-based access

### Administration
- Dashboard metrics
- Patient registration
- Patient search
- Patient profile
- Services management
- Appointment scheduling
- Reservation management
- Invoice creation
- Payment recording

### Patient portal
- Dashboard
- Upcoming appointments
- Reservations
- Invoices

## Important

This is intentionally the first WORKING MVP, not the final clinical/production system.

Payment gateway integration is currently represented by a safe internal payment ledger. A real gateway (for example a Zambia-supported provider) should be added only after we finalize the exact payment provider and its API/webhook requirements.

Clinical modules such as detailed assessments, treatment plans, therapy sessions, progress notes, documents, admissions/rooms/beds, aftercare, reports, audit logs, SMS/email and production payment callbacks are the next refinement stages.

## Reset demo database

For a clean test:

```powershell
php artisan migrate:fresh --seed
```

This deletes existing local test data and rebuilds the demo database.
