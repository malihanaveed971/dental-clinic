# Dental Clinic Frontend

This project has been updated with a clean, multi-page Blade frontend:
- Home booking page (`/`)
- Dentists directory (`/dentists`)
- Appointments (`/appointments`)
- Patient dashboard (`/patients`) (frontend-only placeholder)
- Billing page (`/billing`) (frontend-only placeholder)

## Files changed/added
- Updated:
  - `routes/web.php`
  - `resources/views/layouts/app.blade.php`
  - `resources/views/welcome.blade.php`
  - `resources/views/appointments/index.blade.php`
  - `resources/views/dentists/index.blade.php`
  - `app/Http/Controllers/AppointmentController.php`
- Added:
  - `resources/views/patients/index.blade.php`
  - `resources/views/billing/index.blade.php`

## Note about Phase 3 (Billing backend)
At the moment, the database contains only:
- `users`, `dentists`, `appointments`

Billing-related tables/models/migrations were not found in `database/migrations`. Phase 3 should add the missing schema + controllers + Blade views to make billing fully functional.

