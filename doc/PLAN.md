# JKE: PostgreSQL migration, local auth hardening, Spatie authorization, UI/UX upgrade, controller completion, and project docs

## Goal
Deliver a local-dev-ready Laravel 8 app that runs on PostgreSQL, has no email-verification flow, has complete/functional controllers (including admin/profile) with placeholder data and graceful empty-state handling, isolates client login/logout behavior between the `web` (user) and `admin` guards, uses Spatie-based authorization consistently, upgrades UI/UX for clarity and usability, and adds required project documentation (`AGENTS.md`, `TASKS.md`, `DECISIONS.md`, `GOALS.md`) with strict seeding and git rules.

## Status
Planning revision in progress. Spatie scope and UI/UX depth need confirmation before implementation begins (see Open questions).

## Confirmed decisions (from user)
- Client login/logout sessions must be **isolated** because logging out on the client currently logs out the admin side as well. **Stack-appropriate recommendation (adopted):** keep Laravel server sessions/CSRF as source of truth, but make logout/guest handling **guard-scoped** so user logout never invalidates/destroys the admin session and vice versa; separate cookie/session concerns where needed; no SPA token store added unless required later. Do not introduce Sanctum/JWT in this pass.
- All views/sections drawing from the database must handle empty data gracefully.
- `AGENTS.md` must state that **git commits are allowed; pushing is not allowed** (unless the user explicitly requests a push in a future instruction).
- Use **Spatie** for authentication/authorization work in this pass (scope to be confirmed — see Open questions).
- Upgrade UI/UX.
- Create a proper, structured, modulated `TASKS.md` to start implementation.

## Current state (evidence)
- Framework: Laravel 8.54, Blade, Mix (`composer.json`, `resources/views`, `webpack.mix.js`).
- Auth: Laravel UI/session guards `web`→`users`, `admin`→`admins` (`config/auth.php`, `Auth::routes()`, admin auth under `/admin`). Spatie Permission is already installed/configured for authorization scaffolding: `spatie/laravel-permission` dependency, `config/permission.php`, permission migrations, `HasRoles` on `Admin` (`app/Models/Admin.php`), role/permission middleware aliases registered (`app/Http/Kernel.php`); role/permission admin routes/controllers appear commented/incomplete (`routes/web.php`).
- DB: `config/database.php` default `mysql`; `.env.example` MySQL; `.env` has MySQL + secrets/M-Pesa keys (`.env`, `.env.example`).
- Email verification present but not fully enforced: `User` imports `MustVerifyEmail` (`app/Models/User.php:5`), not implemented; `verified` middleware registered (`app/Http/Kernel.php:66`); `VerificationController` exists; users migration has `email_verified_at`.
- Logout collision root cause: `vendor/laravel/ui/auth-backend/AuthenticatesUsers.php` logout invalidates the whole session; `LoginController` uses trait without guard-scoped logout override; `AdminAuthController::adminLogout` logs out `admin` guard but does not guard-scope session handling (`app/Http/Controllers/Admin/Auth/AdminAuthController.php:36`).
- Stub controllers (all methods empty `//`): `app/Http/Controllers/Admin/KnowledgeBaseController.php`, `KnowledgeBaseImageController.php`, `KnowledgeBaseCategoryController.php`.
- Weak/incomplete areas: `DashboardController@index` mostly commented placeholders; `PagesController`/`UserController`/`MpesaController` hardcode `status => 'Completed'` in places (local simulation acceptable if explicit) and need graceful empty/edge handling review; profile update routes duplicated (`Route::put('/profile'...)` and `Route::put('/profile/update'...)` in `routes/web.php:132,139`).
- Seeders run unconditionally in `database/seeders/DatabaseSeeder.php`; no AGENTS/task/decision/goals docs. UI/UX is functional but inconsistent/dated in places (empty states, feedback, navigation clarity, admin/public polish) — needs a structured upgrade pass.

## Constraints & non-goals
- **Git:** local commits are allowed. **No pushing** unless the user explicitly requests a push. No commits unless the user explicitly asks for a commit in the implementation turn (or an approved workflow requires it) — keep changes reviewable.
- `.env` is sensitive—do not print secrets back into docs; prefer `.env.example`/sanitized guidance.
- Preserve existing Laravel 8 patterns and guard separation unless a change is required.
- Do not add SPA/token auth, external mail provider, or production payment behavior beyond what’s needed for local testability.
- Mutating DB commands (`migrate`, `db:seed`, etc.) must not be run without explicit user permission; document this in `AGENTS.md` and `TASKS.md`.

## Implementation plan (ordered)

### 1) Baseline & safety
1. Create a working branch/backup note only in docs if desired by user later (not now). Record current gaps in `TASKS.md`/`DECISIONS.md`.
2. Audit all Blade views/controllers for DB-derived collections/models used without empty/null guards (`@forelse`, `optional()`, `collect()`, default placeholders, empty-state components/messages). Prioritize: home, catalog/services, portfolio, downloads, bookings, profile, admin dashboard/lists/details, knowledge-base-related views if present.
3. Identify MySQL-specific SQL/raw queries (`DB::raw`, `whereRaw`, date functions, `IFNULL`, backticks, collation assumptions) and convert to portable Eloquent/Query Builder or PG-compatible expressions.

### 2) PostgreSQL migration
4. Update `config/database.php`: keep `pgsql` connection correct; set default fallback strategy to env-driven (`DB_CONNECTION`), document PostgreSQL as required local default. Remove/avoid MySQL-only PDO options assumptions.
5. Update `.env.example` for PostgreSQL local defaults (`DB_CONNECTION=pgsql`, `DB_HOST`, `DB_PORT=5432`, `DB_DATABASE=jke`, `DB_USERNAME`, `DB_PASSWORD` placeholders, `SESSION_DRIVER=file` or `database` per decision below) and remove real credentials/keys from example; add non-secret placeholders for M-Pesa.
6. Add/adjust env handling for local `.env` (do not commit secrets): provide clear setup steps in docs; recommend rotating exposed credentials outside codebase (note in `TASKS.md`/`DECISIONS.md`).
7. Review migrations for PG compatibility (`database/migrations/*`): `enum`/`json`/`foreignId`/timestamps are generally fine on Laravel 8 but verify edge cases (Spatie permission migration team foreign keys, `sessions.user_id` nullable FK behavior, any `unsigned` display assumptions, string lengths/index names). Fix only where incompatible.
8. Validate with `php artisan migrate:fresh` **only after explicit user permission**; prepare seed command as a separate, permission-gated step.

### 3) Remove email verification (local)
9. Remove verification flow: stop using `MustVerifyEmail` on `User` (and any related traits/notifications needed), remove/disable `['verify' => true]` if present, remove `verified` middleware from routes, keep or simplify `VerificationController`/views only if routes reference them (prefer removing unused routes/views cleanly).
10. Update registration/login/profile UX to not prompt for verification. Ensure `email_verified_at` remains harmless (nullable) unless schema change is explicitly desired.
11. Set `MAIL_MAILER=log` (or array) in `.env.example` for local; no external provider required.

### 4) Guard-isolated client login/logout (fix admin/user collision)
12. Override user logout in `app/Http/Controllers/Auth/LoginController.php` (trait method) to logout only `Auth::guard('web')`, clear/regenerate session state **without destroying the other guard’s authentication**. Preferred approach: `Auth::guard('web')->logout(); $request->session()->forget(...)` for guard-specific keys as appropriate; `$request->session()->regenerateToken();` and redirect; avoid `$request->session()->invalidate()`/`flush()` that nukes admin. Verify against Laravel 8 session guard key format.
13. Update `AdminAuthController::adminLogout` similarly: logout only `admin` guard, regenerate CSRF token, preserve `web` session.
14. Harden `RedirectIfAuthenticated` to redirect each guard to its correct home (`web`→profile/home, `admin`→admin dashboard) instead of always `RouteServiceProvider::HOME`.
15. Ensure admin routes use `guest:admin` / `adminauth` appropriately; user auth routes use `guest:web` where applicable. Confirm forms/links post to the correct logout endpoints (`routes/web.php`, Blade navs).
16. Add/adjust tests or manual validation steps for: login user + login admin in same browser profile (where session design allows), logout user leaves admin active and vice versa. Document limitation if same-cookie session driver cannot fully isolate concurrent guard identities in one browser session; if needed, use distinct session cookie names/paths or documented local workflow (incognito/separate profile) — choose least disruptive approach and record in `DECISIONS.md`.

### 5) Spatie authorization hardening (proposed scope — confirm)
17. Treat Spatie as the **authorization** layer (roles/permissions) on top of existing Laravel session/guard authentication, unless the user explicitly wants a different architecture. Do **not** replace guard-based login/logout with a package that conflicts with the current Laravel 8 + Blade + dual-guard setup.
18. Audit and align Spatie Permission usage: `config/permission.php`, migrations, `HasRoles`/guard config on `Admin` and any `User` role needs, permission cache, seed data for roles/permissions (permission-gated), and middleware aliases in `app/Http/Kernel.php`.
19. Apply authorization consistently to admin/public boundaries: `adminauth` + appropriate Spatie `role`/`permission`/`role_or_permission` middleware or policy checks for sensitive admin modules; keep public/user flows accessible as intended. Reuse commented role/permission route/controller scaffolding only if it becomes functional and needed.
20. Ensure admin UI reflects allowed actions (hide/disable unauthorized controls where practical) but enforce authorization on the server. Add placeholder roles/permissions for local simulation/testing only via permission-gated seeding.

### 6) Complete/functional controllers (no stubs) + placeholders/simulation
21. **KnowledgeBase admin (stubs):** implement full CRUD in `KnowledgeBaseController`, `KnowledgeBaseCategoryController`, `KnowledgeBaseImageController` consistent with existing models/migrations/routes/views (`app/Models/KnowledgeBase*`, migrations, `routes/web.php` commented/admin groups as applicable). If routes/views are missing, add minimal functional admin resource routes and Blade views following existing admin patterns (`admin.*` layout, forms, index/create/edit/show). Use placeholder content/images (seed URLs like picsum/placehold.co or local placeholder assets) and validation.
22. **DashboardController:** replace commented demo-only behavior with real, cheap aggregate queries where models/tables exist (counts for users/admins/services/bookings/payments/bundles/subscriptions/portfolios/etc.), all null-safe and empty-safe; keep charts/metrics optional and simulated from available data/placeholders when analytics tables are absent.
23. **All admin controllers:** review every controller under `app/Http/Controllers/Admin/` for missing validation, missing authorization assumptions, dead code, non-functional actions, and empty-state view support. Ensure index/show/create/edit/store/update/destroy paths behave sensibly with no records.
24. **PagesController/UserController/profile/Mpesa flows:** make booking/subscription/payment simulation explicit and testable locally (no external gateway dependency). Replace hardcoded “Completed” shortcuts with a consistent local simulation strategy (e.g., env `PAYMENT_SIMULATE=true`/local default) that records pending→completed transitions safely for local testing, while preserving callback/status endpoints’ structure. Ensure retry/status pages handle missing IDs/records gracefully.
25. **Auth/profile:** ensure profile views/controllers handle missing phone/subscriptions/transactions/bookings; fix duplicate profile update route; ensure password/profile updates validate and respond clearly.
26. **Seeders/factories/placeholders:** add/update factories/seeders to produce realistic placeholder data for all major entities (users/admins/services/categories/types/portfolios/memes/bundles/software/knowledge base/bookings/payments/subscriptions/faqs/holidays/hours as applicable) using safe placeholder images/text. `DatabaseSeeder` must remain **non-destructive by default** and/or be clearly guarded by process/docs; no auto-run.

### 7) Graceful empty-data handling (global pass)
27. Apply a systematic pass over `resources/views/**`: replace unsafe `->count()`/`$x->y` chains on nullable results, guard `@foreach`, show helpful empty states (“No records yet”, placeholder cards/tables), and ensure admin/public pages render without 500s on fresh DB.
28. Add defensive checks in controllers for `find`/relations returning null where views assume presence; return 404 or empty models as appropriate.

### 8) UI/UX upgrade (modular, preserve Blade/Mix stack)
29. Establish lightweight UI conventions: consistent spacing/typography scale, buttons/forms, table/card patterns, status badges, alerts/toasts for success/error, loading/disabled states for submits, and accessible labels/focus states.
30. Improve navigation and layout clarity: distinguish user vs admin areas, show current user/admin context safely, clear logout actions per guard, breadcrumbs/page titles where useful, responsive behavior for key pages.
31. Upgrade high-impact screens first: auth pages, profile, bookings/payment waiting, public catalog/portfolio/downloads/contact, admin dashboard, admin CRUD index/forms/show pages, and empty/error states. Keep changes incremental and compatible with existing Bootstrap/Mix assets unless a focused dependency change is necessary.
32. Add placeholder imagery/content presentation (cards, avatars/icons, skeleton/empty illustrations/text) so seeded and empty states both look intentional.

### 9) Required documentation
33. Create `AGENTS.md` (repo root) with:
    - project overview/stack (Laravel 8, PostgreSQL local target, Blade/Mix, Laravel session auth, Spatie Permission);
    - setup basics (env, key, migrate) **without secrets**;
    - **Git policy:** local commits allowed; **never push** unless the user explicitly requests it.
    - **Seeding policy (critical):** seeding/reseeding is restricted; agent/human must **always ask for explicit permission before any `db:seed`, `migrate:fresh --seed`, `migrate:refresh --seed`, or destructive DB reset/reseed action**. State “never seed/reseed without permission” clearly.
    - guard/auth notes (web/admin isolation behavior, logout semantics, Spatie authorization boundaries);
    - local payment/mail simulation notes.
34. Create `GOALS.md`: goals tied to current situation (local operability on Postgres, testable UI/data, no email dependency, isolated sessions, Spatie authorization, complete controllers, UI/UX upgrade, safe seeding).
35. Create `TASKS.md` as a **proper structured, modulated execution board** (see blueprint below) — the primary starting point for implementation.
36. Create `DECISIONS.md`: key decisions (Postgres default, email verification removed for local, guard-scoped logout/session approach, Spatie role in this stack, UI/UX scope, local payment simulation strategy, placeholder data sources, seeding/git policies, any schema/route compatibility choices).

### 10) Validation (run/perform only with appropriate permissions)
37. Static checks: `php -l` on touched PHP files; run project lint/test commands if configured (`vendor/bin/phpunit` or `php artisan test`) — check availability first.
38. Manual smoke flows (local): migrate/setup (permission-gated), seed (permission-gated), register/login user, login admin, verify logout isolation, verify Spatie-protected admin actions behave correctly, browse public/admin pages with empty DB and seeded DB, profile/subscription/booking/payment-sim flows, KnowledgeBase admin CRUD, and key UI states (empty/loading/error/success/responsive).
39. Re-scan for remaining `MustVerifyEmail`/`verified` route enforcement, stub markers, MySQL-specific SQL, unsafe empty-data rendering, and missing authorization on admin actions.

## TASKS.md blueprint (to create during implementation)
`TASKS.md` should be the canonical, modulated execution board. Structure it with:
- **Header:** purpose, status legend (`todo`/`in_progress`/`blocked`/`done`), owner/agent notes, and links to `GOALS.md`/`DECISIONS.md`.
- **Global rules:** no seed/reseed/migrate-destructive action without explicit permission; local commits allowed, no push unless explicitly requested; verify empty states and authorization for every touched module.
- **Module 0 — Baseline & docs:** inventory gaps, create `AGENTS.md`/`GOALS.md`/`DECISIONS.md`/`TASKS.md`, capture `.env`/secrets risk note (no secret values).
- **Module 1 — PostgreSQL & environment:** `config/database.php`, `.env.example`, migration PG compatibility audit, optional local `.env` guidance, permission-gated migration/seed validation.
- **Module 2 — Auth & session isolation:** remove email verification, guard-scoped user/admin logout, `RedirectIfAuthenticated` fixes, route middleware alignment, manual isolation test cases.
- **Module 3 — Spatie authorization:** confirm scope, align config/models/migrations/cache, seed roles/permissions (permission-gated), protect admin routes/actions, reflect permissions in UI where practical.
- **Module 4 — Controllers & domain flows:** KnowledgeBase stub completion (+ routes/views), dashboard aggregates, admin CRUD audit, public pages/profile/payment simulation, duplicate route cleanup.
- **Module 5 — Data, placeholders & empty states:** factories/seeders/placeholder assets, safe `DatabaseSeeder` behavior, global Blade/controller empty-state pass.
- **Module 6 — UI/UX upgrade:** design conventions, shared layout/components/partials, auth/profile/admin/public screen upgrades, accessibility/responsive checks.
- **Module 7 — Validation & handoff:** static checks, smoke tests, residual-risk list, follow-up items.
- **Per-task fields (table/checklist):** ID, module, title, files/area, dependencies, permission gate (yes/no), validation, status, notes.

## Risks / watchouts
- **Spatie scope ambiguity:** Spatie is already present as **Permission** (authorization). If the user means “replace login/authentication with Spatie”, that conflicts with current Laravel UI/session guards and needs an explicit decision before implementation.
- **Session isolation across guards in one browser session:** Laravel’s default session stores auth per guard, but full session invalidation/logouts and shared cookie behavior can still cause surprises; changes must be validated carefully and documented.
- **`.env` contains secrets** (DB password, M-Pesa credentials): treat as compromised-local risk; do not propagate; recommend rotation.
- **Payment flow semantics:** existing code marks payments complete in places; local simulation must not create confusing “fake production” behavior—gate by env and make visible in admin/dev UI where useful.
- **KnowledgeBase schema/routes/views may be partially missing or inconsistent with stubs;** implementation must align model/table names (`knowledge_bases`, pivot table names) exactly.
- **Postgres enum/check constraints:** Laravel schema builder support differs by version; verify migrations on PG before declaring done.
- **UI/UX scope creep:** keep the upgrade modular and incremental; avoid a framework rewrite unless explicitly requested.

## Open questions (must resolve before implementation)
1. **Spatie scope (recommended: B):** A) replace the app’s authentication/login system with a Spatie package (high impact/risky on Laravel 8 + dual guards; specify which package), or **B) use Spatie Permission as the authorization layer** — roles/permissions/policies/middleware on top of the existing Laravel guard-based login/auth (fits current stack). Reply `A` or `B`.
2. **UI/UX depth (recommended: 2):** 1) light polish (empty states, spacing, alerts, consistency only), **2) moderate upgrade** (shared layout/components, improved navigation/forms/tables/cards, responsive/accessibility pass on key screens), or 3) major redesign (new visual system across most/all screens). Reply `1`, `2`, or `3`.
