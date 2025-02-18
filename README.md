# Court Hub - Sports Court Booking System

## Overview

Court Hub is a comprehensive sports court booking system developed to simplify the process of booking and managing sports court reservations. This project demonstrates our expertise in modern back-end technologies and system integration.

## Watch the Demo

[System Demo](https://lnkd.in/ggvFcagy)

## Key Features

- **Real-time Court Availability:** Instantly check available slots for bookings.
- **Secure Online Payments:** Integrated Stripe API for seamless and secure payments.
- **Automated Booking Confirmations:** Users receive booking confirmations via email.
- **Google Calendar Integration:** Sync bookings with users' Google Calendar.
- **Administrative Dashboard:** Manage bookings and generate daily PDF reports for admins.

## Technical Highlights

- **Framework:** PHP/Laravel
- **Payment Gateway:** Stripe API
- **Calendar Integration:** Google Calendar API
- **Email Notifications:** Booking confirmation and payment details
- **Automated Reports:** PDF daily booking report for administrators
- **Hosting:** Deployed on Hostinger with full SSL security

---

## Installation and Setup Instructions

### Prerequisites

Ensure you have the following installed:

- PHP (version 8.0 or higher)
- Composer
- Node.js (for front-end assets)
- Laravel CLI
- MySQL Database
- Laragon (or XAMPP for local development)
- MySQLYog (or another MySQL GUI)

### 1. Clone the Repository

```bash
git clone https://github.com/your-repo-name/court-hub.git
cd court-hub
```

### 2. Install Dependencies

Run the following command to install all necessary dependencies:

```bash
composer install
```

### 3. Set Up Environment Variables

Create a `.env` file by copying the example file:

```bash
cp .env.example .env
```

Modify the `.env` file to include your database and API credentials:

```plaintext
APP_NAME="Court Hub"
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=court_hub
DB_USERNAME=root
DB_PASSWORD=yourpassword

STRIPE_KEY=your_stripe_key_here
STRIPE_SECRET=your_stripe_secret_here

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT=http://localhost/auth/google/callback
```

### 4. Generate the Application Key

```bash
php artisan key:generate
```

### 5. Configure the Database

Create a database in MySQL named `court_hub` (or any name you prefer). Update the `.env` file accordingly.

### 6. Run Migrations

Execute the following command to create the necessary database tables:

```bash
php artisan migrate
```

### 7. Seed the Database (Optional)

To populate the database with sample data:

```bash
php artisan db:seed
```

### 8. Set Up Stripe Webhooks (Optional)

Follow Stripe's documentation to set up webhooks if needed for your environment.

### 9. Compile Front-end Assets

```bash
npm install
npm run dev
```

### 10. Start the Development Server

```bash
php artisan serve
```

Access the system at `http://localhost:8000`.

---

## Deployment Instructions

For deployment, ensure the following steps are taken:

1. **Hosting:** Upload the project to your Hostinger server.
2. **SSL Security:** Enable SSL from Hostinger’s control panel.
3. **Environment Configuration:** Update the `.env` file with production settings.
4. **Optimize:** Run Laravel optimization commands:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## Troubleshooting

- **Database Connection Issues:** Ensure the correct database credentials are in the `.env` file.
- **Stripe Errors:** Verify your Stripe API keys and webhook configuration.
- **Email Issues:** Ensure SMTP settings are correctly configured in the `.env` file.

## Contributions

Feel free to fork the repository and submit pull requests for improvements or feature suggestions.

## License

This project is licensed under the [MIT License](LICENSE).



