# AGENTS.md — JKE

## Project overview
- **Stack:** Laravel 8.54 (PHP), Blade views, Laravel Mix (`webpack.mix.js`), Spatie Permission for authorization scaffolding.
- **Auth model:** Laravel session/guard authentication.
  - `web` guard → `users` (public/user area)
  - `admin` guard → `admins` (admin area under `/admin`)
  - Spatie Permission is used/aligned as **authorization** (roles/permissions) on top of guard-based auth, unless an explicit future decision replaces this.
- **Local target:** PostgreSQL (migration from MySQL in progress/planned). Do not assume MySQL-only behavior in new changes.
- **Docs:** `doc/PLAN.md`, `doc/TASKS.md`, `GOALS.md`, `DECISIONS.md`.

## Local setup (no secrets)
```bash
cp .env.example .env   # if needed; fill local placeholders only
# set DB_CONNECTION=pgsql and local PostgreSQL credentials
php artisan key:generate
# migrations require explicit user permission before running destructive/setup actions
php artisan migrate
# seeding/reseeding requires explicit user permission before running
# php artisan db:seed
```
- Use `.env.example` placeholders. Never commit or paste real `.env` secrets (DB passwords, API keys, M-Pesa credentials).
- Local mail should use `MAIL_MAILER=log` (or `array`) until a real provider is configured.

## Git policy
- **Local git commits are allowed.**
- **Never push** to any remote unless the user explicitly requests a push in that conversation/task.
- Keep commits focused and reviewable. Do not commit secrets.

## Seeding policy (critical)
Seeding and reseeding are **restricted**.

**Never run any of the following without explicit user permission in the current conversation:**
- `php artisan db:seed`
- `php artisan migrate:fresh --seed`
- `php artisan migrate:refresh --seed`
- any destructive database reset, truncate, reseed, or equivalent action

If a task needs seed data, stop and ask for explicit permission first. Mark permission-gated tasks as blocked until permission is granted.

## Authentication & session isolation
- User and admin sessions must be isolated by guard behavior.
- **User logout must not log out the admin session. Admin logout must not log out the user session.**
- Avoid full session invalidation/flush for guard-specific logout flows unless a carefully reviewed change is required.
- Keep CSRF/session handling compatible with Laravel 8 Blade forms.
- Guest redirects must be guard-aware (`web` and `admin` go to their correct destinations).

## Authorization (Spatie)
- Use Spatie Permission consistently for roles/permissions where applicable.
- Enforce authorization **on the server** (middleware/policies/controller checks). UI may hide/disable actions, but UI is not sufficient.
- Role/permission seeding is permission-gated (see Seeding policy).

## Data/UI quality rules
- All views/sections drawing from the database must handle empty data gracefully (empty states, null-safe access, `@forelse`/guards/placeholders).
- Controllers should return safe responses for missing/empty records as appropriate.
- Use placeholders (including safe online placeholder images/content where useful) for local testing/simulation.
- Payment/M-Pesa flows should be explicitly local-simulatable where gateway access is unavailable; do not present simulation as real production settlement.

## Working conventions
- Follow existing Laravel 8/Blade/Mix patterns unless a change is necessary.
- Prefer portable Eloquent/Query Builder code over MySQL-specific SQL.
- Update `doc/TASKS.md` status/notes as work progresses.
- Record significant decisions in `DECISIONS.md` and goal/status changes in `GOALS.md`.
