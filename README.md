# Dental Clinic Management System

A modern and robust Dental Clinic Management System built to streamline clinic workflows, manage patient records, track treatments, and handle financial balances with real-time UI updates.

## Key Features

* **Smart Patient Records:** Clean, read-only patient profiles with comprehensive details.
* **Real-time Financial Tracking:** Automatic recalculation of patient balances (Total Cost, Total Payments, Remaining Balance) using Livewire events, without page reloads.
* **Treatments & Payments Management:** Inline management directly from the patient's record view.
* **Advanced Data Tables:** Searchable, sortable, and filterable tables with visual financial status badges.
* **Access Control:** Strict access rules ensuring users manage only authorized clinic data.

## Tech Stack

* **Backend Framework:** Laravel 
* **Admin Panel & UI Engine:** Filament PHP
* **Reactivity:** Livewire 3 & Alpine.js
* **Database:** MySQL & Eloquent ORM
* **Styling:** Tailwind CSS

## Quick Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/MayarMuslih/dentist-sys.git](https://github.com/MayarMuslih/dentist-sys.git)
   cd dentist-sys
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Setup environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *(Make sure to configure your database credentials in the `.env` file)*

4. **Run migrations:**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the server:**
   ```bash
   php artisan serve
   ```
   *Access the admin dashboard at `http://127.0.0.1:8000/admin`.*
