# My Baltic Car

A used car aggregator for the Baltic region. Aggregates listings from SS.com (Latvia), Autoportaal.ee (Estonia) and Autogidas.lt (Lithuania) into one searchable interface.

**Problem it solves:** After getting a driver's license, young people in the Baltics often want to buy a car from a neighbouring country. There's no single site that shows listings from all three Baltic markets at once.

---

## Features

- Browse used car listings from Latvia, Estonia and Lithuania in one place
- Filter by brand, model, year range and price range
- Filter by country (LV / EE / LT)
- Sort by price, mileage or year
- Detail page with link back to the original listing

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 11 (PHP) |
| Frontend | Blade templates + Tailwind CSS v4 |
| Database | MySQL |
| Scraper | Python (see `/scraper`) |

---

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL

---

## Installation

```bash
# 1. Clone the repo
git clone https://github.com/DavsCavs/nosl-d-pt22.git
cd nosl-d-pt22

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies and build assets
npm install
npm run build

# 4. Set up environment
cp .env.example .env
php artisan key:generate

# 5. Configure database in .env
DB_DATABASE=sscarsdb
DB_USERNAME=root
DB_PASSWORD=

# 6. Run migrations
php artisan migrate

# 7. Start the dev server
php artisan serve
```

Then populate the database by running the scraper (see `/scraper/README.md`).

---

## Routes

| Method | Path | Description |
|--------|------|-------------|
| GET | `/` | Home / search page |
| GET | `/cars` | Listing with filters |
| GET | `/cars/{id}` | Car detail page |

---

## Database

Table: `cars`

| Column | Type | Description |
|--------|------|-------------|
| brand | string | Car brand (e.g. BMW) |
| model | string | Model name |
| year | string | Year of manufacture |
| engine_size | string | Engine displacement (e.g. 2.0) |
| mileage | integer | Mileage in km |
| price | integer | Price in EUR |
| url | string (unique) | Link to original listing |
| image_url | string | Photo URL |
| country | string(2) | LV / EE / LT |
