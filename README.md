# Bootcamp Management Platform

A Laravel 12 application for managing public bootcamp programmes, participant enrollments, payment processing (Midtrans Snap), and post-course certification. The project ships with an authenticated student dashboard, a role-based administration area, and a marketing-facing public site.

## Tech Stack

- PHP 8.2 + Laravel 12 with Jetstream & Livewire
- MySQL / SQLite (local development)
- Vite, Tailwind CSS 4, Alpine.js
- Midtrans Snap for payments, DomPDF for certificate generation

## Requirements

- PHP 8.2+ with `pdo_mysql`, `fileinfo`, `gd`
- Composer 2.6+
- Node.js 18+ and npm 9+
- MySQL 8 / MariaDB 10.6 (or SQLite for quick start)

## Getting Started

1. **Install dependencies**
   ```bash
   composer install
   npm install
   ```
2. **Copy the environment file and generate the app key**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. **Configure the environment**
   - Set database credentials (`DB_*`).
   - Provide Midtrans keys (`MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY`).
   - Set the admin seeder variables before running migrations:
     ```env
     ADMIN_NAME="Bootcamp Admin"
     ADMIN_EMAIL=admin@example.com
     ADMIN_PASSWORD=ChangeMe123!
     ```
4. **Run migrations & seeders**
   ```bash
   php artisan migrate --seed
   ```
   The admin seeder will create / update the user defined by `ADMIN_EMAIL` with the password from `ADMIN_PASSWORD`.
5. **Build frontend assets**
   ```bash
   npm run build     # for production
   # or
   npm run dev       # for local HMR
   ```
6. **Serve the application**
   ```bash
   php artisan serve
   ```
   For development convenience you can also use the bundled script:
   ```bash
   composer run dev
   ```
   which starts the Laravel server, queue listener, pail, and Vite concurrently.

## Environment Variables

| Key | Purpose |
| --- | --- |
| `APP_URL` | Base application URL used for routing and callbacks |
| `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD` | Credentials for the seeded administrator account |
| `MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY` | Midtrans API credentials |
| `MIDTRANS_IS_PRODUCTION` | Set to `true` in production, keep `false` for sandbox |
| `MIDTRANS_SANITIZED_REDIRECT_URL` / `MIDTRANS_3DS_REDIRECT_URL` | Optional override URLs for Midtrans callbacks |

Ensure the notification endpoint (`/payment/notification`) is reachable from Midtrans and that the URL is added to your Midtrans dashboard.

## Testing

Run the application test suite:
```bash
php artisan test
```
Upcoming work adds end-to-end coverage for the enrollment and payment flow—run the suite after each change.

## Payments

The checkout flow asks Midtrans for a Snap token server-side and loads the client key dynamically. Successful webhooks mark orders as paid and confirm the linked enrollment. Failed / expired webhooks roll the enrollment status back to `pending`.

## Certificates

Certificates are generated as PDFs via DomPDF (`barryvdh/laravel-dompdf`). The admin UI supports issuing, revoking, regenerating, and exporting certificate data. Bulk generation is available for all completed enrollments without certificates.

## Useful Commands

- `php artisan optimize:clear` – Clear caches during development.
- `php artisan migrate:fresh --seed` – Reset and reseed the database.
- `php artisan queue:listen` – Process background jobs (emails, notifications).

## Notes

- Session storage defaults to the file driver for out-of-the-box usage; switch to Redis or database for clustered deployments.
- Always change the seeded admin password in `.env` before deploying.
- Update Midtrans settings (allowed origins, notification URLs) whenever the public domain changes.
