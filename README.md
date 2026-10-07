# Leaf Log

A lightweight houseplant-care tracker built with Laravel. Log your plants, track when each one was last watered, and let Leaf Log flag the ones that are getting thirsty.

## Features

- **Dashboard** — total plants, thirsty count, and watered-today stats, a "Needs water" list, and a room chip cloud for quick filtering.
- **Plant collection** — full CRUD with search by name/species (`?q=`) and filtering by room (`?room=`).
- **Watering** — one-click "Water now" sets `last_watered_at` to today.
- **Plant detail** — watering interval, last-watered date ("N days ago"), notes, and a Thirsty/Happy status badge.
- **Tips** — a static care-tips page with a live thirsty-plant count.

Thirsty logic lives on the model: a plant is thirsty when it has never been watered or when `daysSinceWatering() >= water_every_days` (see `app/Models/Plant.php`).

## Tech Stack

- Laravel 13 on PHP ^8.3
- Blade + Tailwind CSS v4 + Vite 8 (no SPA, no Inertia/Livewire)
- SQLite (default), with `database` drivers for sessions, cache, and queues
- Pest 5 for testing

## Requirements

- PHP 8.3+
- Composer
- Node.js + npm (for Vite asset building)

## Setup

### Quick start

```bash
composer setup
```

This installs Composer deps, copies `.env`, generates an app key, runs migrations, installs npm deps, and builds assets.

### Manual setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

SQLite is used by default — `database/database.sqlite` is created automatically by the migration setup. No extra database configuration is needed.

### Optional seed data

```bash
php artisan db:seed   # 10 plants (8 random + 2 named)
```

## Usage

Start the dev stack (server, queue, logs, Vite together):

```bash
composer dev
```

Or run pieces separately:

```bash
php artisan serve      # http://localhost:8000
npm run dev            # Vite asset server
```

### Pages

| Method | URI | Description |
|---|---|---|
| GET | `/` | Dashboard: stats, thirsty list, room chips |
| GET | `/tips` | Care tips + live thirsty count |
| GET | `/plants` | Plant list; supports `?q=` search and `?room=` filter |
| GET | `/plants/create` | New plant form |
| POST | `/plants` | Create plant (validated by `PlantRequest`) |
| GET | `/plants/{plant}` | Plant detail with Water/Edit/Delete actions |
| GET | `/plants/{plant}/edit` | Edit plant form |
| PUT/PATCH | `/plants/{plant}` | Update plant |
| DELETE | `/plants/{plant}` | Delete plant |
| POST | `/plants/{plant}/water` | Mark plant as watered today |

### Validation rules

Defined in `app/Http/Requests/PlantRequest.php`:

- `name`, `species`, `room` — required, max 255 (room max 100)
- `water_every_days` — required integer, 1–90 (defaults to 7 on the create form)
- `last_watered_at` — optional date, not in the future
- `notes` — optional, max 1000 characters

## API

There is no HTTP API — Leaf Log is a fully server-rendered Blade application. All interactions happen through the web routes listed above.

## Testing

```bash
php artisan test --compact   # or: vendor/bin/pest
```

Feature coverage lives in `tests/Feature/PlantCareTest.php` (dashboard stats, filtering, CRUD, watering, tips). Tests run against an in-memory SQLite database.

## Project Structure

```
app/
  Http/Controllers/     DashboardController, PlantController
  Http/Requests/        PlantRequest (validation)
  Models/               Plant, User
database/
  factories/            PlantFactory (states: thirsty, watered)
  migrations/           ... + create_plants_table
resources/views/
  layouts/              app layout with nav
  dashboard, tips       main pages
  plants/               index, create, edit, show, form
  partials/             flash, plant-row
routes/web.php          all routes
tests/Feature/          PlantCareTest
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
