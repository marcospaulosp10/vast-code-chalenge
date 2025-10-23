# Typing Speed Test

I used the best of resouces of laravel and Vue.
I have implemented some anti-cheat.
I used tailwind for the styles.

## Setup Instructions

### Requirements
- PHP ≥ 8.2  
- Composer  
- Node.js ≥ 18  
- MySQL (or MariaDB)

### Backend (Laravel API)

```bash
# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure DB in .env
# Then migrate and seed data
php artisan migrate --seed

# Run Laravel server
php artisan serve
Backend runs at: http://127.0.0.1:8000

Frontend (Vue 3 + Vite + TailwindCSS)
bash
Copy code
# Install Node dependencies
npm install

# how to run development server
npm run dev
Frontend runs at: http://127.0.0.1:5173, but should be accessed via http://127.0.0.1:8000 (served by Laravel).