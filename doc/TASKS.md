# TASKS.md — JKE execution board

Purpose: canonical, modulated starting point for the JKE local-dev hardening/migration work.  
Status legend: `todo` | `in_progress` | `blocked` | `done`  
Related: `doc/PLAN.md`, `GOALS.md`, `DECISIONS.md`, `AGENTS.md` (repo root).

## Global rules
- **Permission gate (critical):** never run `db:seed`, `migrate:fresh --seed`, `migrate:refresh --seed`, or any destructive DB reset/reseed without explicit user permission. Mark such tasks `blocked` until permission is given.
- **Git:** local commits are allowed when explicitly requested/approved; **never push** unless the user explicitly requests it.
- **Quality gates for touched modules:** handle empty DB states gracefully; enforce authorization on the server; keep UI feedback clear (success/error/empty/loading where relevant).
- **Secrets:** do not copy `.env` secrets into docs or commits. Use `.env.example` placeholders only.
- **Open decisions:** resolved 2026-11-08 — Spatie scope **B**, UI/UX depth **2**.

## Module 0 — Baseline & docs
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M0-01 | Inventory gaps and evidence | controllers, routes, views, auth, DB config, seeders | — | no | checklist captured in docs | done | Baseline captured in `doc/PLAN.md` (current state/evidence). |
| M0-02 | Create `AGENTS.md` (root) | `AGENTS.md` | M0-01 | no | includes stack, setup w/o secrets, commits allowed/no push, **no seed/reseed without permission**, guard/Spatie/local simulation notes | done | Created with git/seeding/auth/data/UI policies. |
| M0-03 | Create `GOALS.md` | `GOALS.md` | M0-01 | no | goals match current situation/upgrades/bugs | done | Created with goals/success criteria. |
| M0-04 | Create `DECISIONS.md` | `DECISIONS.md` | M0-01 | no | records resolved decisions + open items | done | Includes resolved decisions, open D-OPEN-01/02, risks. |
| M0-05 | Confirm open decisions | Spatie scope, UI/UX depth | M0-01 | no | user replies A/B and 1/2/3 | done | User selected **B,2** (2026-11-08): Spatie Permission as authorization on existing Laravel `web`/`admin` session guards; moderate UI/UX upgrade. Unblocks M3 depth and M6 scope. |

## Module 1 — PostgreSQL & environment
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M1-01 | Set PostgreSQL as local default | `config/database.php` | M0-01 | no | env-driven default; pgsql config correct; no MySQL-only assumptions | done | Default set to `env('DB_CONNECTION','pgsql')`; pgsql connection kept; MySQL connection retained for compatibility but not default. `php -l` passed. |
| M1-02 | Sanitize/update env template | `.env.example` | M1-01 | no | pgsql placeholders, `MAIL_MAILER=log`, M-Pesa placeholders only, no secrets | done | Replaced with PostgreSQL placeholders, log mail, and non-secret M-Pesa placeholders (`MPESA_SIMULATE=true`). Real `.env` not modified. |
| M1-03 | PG compatibility audit for migrations | `database/migrations/*` | M1-01 | no | enums/json/foreign keys/indexes/session/spatie tables reviewed | done | Scanned migrations: `foreignId`/`unsignedBigInteger`/timestamps/nullable are portable; `enum`/`json` used (Laravel 8 maps acceptably for PG/local testing — verify on real migration). Spatie migration has commented `//$table->engine('InnoDB')` only. No active MySQL-only schema calls found. Runtime verification blocked pending M1-05 permission. |
| M1-04 | Audit raw SQL/DB portability | controllers, models, services | M1-01 | no | no MySQL-specific SQL remains where PG would break | done | `app/` + seeders/factories scan found `DB::raw` only in commented dashboard code (`app/Http/Controllers/Admin/DashboardController.php:130,131,147,148,184,185`) — no active runtime MySQL-specific SQL found. Re-audit when implementing dashboard aggregates. |
| M1-05 | Run migrations locally | artisan migrate | M1-03,M1-04 | **yes** | schema builds on PostgreSQL | done | User granted permission; initial migration completed on 2026-11-08 against PostgreSQL 17 (port 5433, db `pabe_jke_db`) via `php artisan migrate --force` (35 migrations successful). |
| M1-06 | Run seeders locally | artisan db:seed / fresh --seed | M1-05 | **yes** | placeholder data loads; no destructive action without permission | done | User granted permission (first seeding, 2026-11-08). `php artisan db:seed --force` completed successfully after fixing PG incompatibilities: `CreateAdminSeeder` converted from MySQL backtick raw SQL to portable query-builder inserts; `ServiceTriggerSeeder` now emits PostgreSQL trigger/function (and retains MySQL path). All configured seeders ran. |

## Module 2 — Auth & session isolation
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M2-01 | Remove email verification (local) | `User`, routes, `VerificationController`, views, kernel refs | M0-01 | no | no verification prompts/enforcement; registration/login usable | done | Removed `MustVerifyEmail` import from `User`; removed `verified` middleware alias from kernel; `Auth::routes(['verify'=>false])`; `email_verified_at` cast left harmless. `verify.blade.php` remains unused. |
| M2-02 | Fix user logout isolation | `app/Http/Controllers/Auth/LoginController.php` | M0-01 | no | web logout does not invalidate admin session | done | Overrode logout to `Auth::guard('web')->logout()`, forget web guard session key, `regenerateToken()` only (no full invalidate/flush). Fixed welcome name to use `first_name/last_name/email`. |
| M2-03 | Fix admin logout isolation | `app/Http/Controllers/Admin/Auth/AdminAuthController.php` | M0-01 | no | admin logout does not invalidate web session | done | Guard-scoped admin logout; forget admin guard key; `regenerateToken()`; login regenerates session; tightened `is_admin` check. |
| M2-04 | Guard-aware guest redirects | `RedirectIfAuthenticated`, route middleware | M2-02,M2-03 | no | web/admin guests redirect to correct homes | done | `admin` guard redirects to `dashboard.index`; others use `RouteServiceProvider::HOME`. |
| M2-05 | Route/auth UX cleanup | `routes/web.php`, navs, forms | M2-01..M2-04 | no | correct endpoints, no duplicate profile routes, clear labels | done | Admin login routes under `guest:admin`; admin logout/dashboard guarded; removed duplicate `profile.update` mapping (now `PUT /profile` → `updateProfile`); grouped profile/subscription routes under `auth:web`. |
| M2-06 | Manual auth isolation smoke test | browser/session flows | M2-05 | no | user+admin login/logout matrix documented | todo | Requires local runtime/browser check; DB/app run not executed. |

## Module 3 — Spatie authorization
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M3-01 | Confirm Spatie scope | architecture decision | M0-05 | no | A or B selected and recorded | done | Resolved as **B** (2026-11-08): Spatie Permission for authorization on existing session guards. |
| M3-02 | Align Spatie Permission config/models | `config/permission.php`, `Admin`, `User` as needed, migrations | M3-01 | no | guards/cache/tables/traits coherent | done | `Admin`/`User` have `HasRoles` + guard names; kernel has Spatie middleware; `AdminAuthenticated` accepts `is_admin` or Spatie `super-admin|manager|viewer` (admin guard). |
| M3-03 | Define local roles/permissions map | seeders/docs | M3-02 | no | minimal useful roles/permissions for admin modules | done | `RolesAndPermissionsSeeder` defines admin-guard permissions and `super-admin`/`manager`/`viewer`. Not in `DatabaseSeeder`. |
| M3-04 | Seed roles/permissions | seeders | M3-03 | **yes** | roles/permissions exist locally | done | User granted permission (2026-11-08): seeded roles/permissions and assigned `super-admin` to existing admin accounts for local access. |
| M3-05 | Protect admin actions | routes, controllers, middleware/policies | M3-02 | no | sensitive actions server-enforced | in_progress | Admin mutations behind per-module `permission:*,admin` middleware (`routes/web.php`); controller `__construct` middleware added across admin CRUD controllers; `@can` action gates on admin index/show views (44 view checks). Payments mutations/export currently under `admin.bookings.manage` (viewer read-only intent; consider `admin.payments.manage` split — seeder permission-gated). Remaining: full per-permission controller/policy checks in all actions, `@can` on create/edit forms where useful. |
| M3-06 | Spatie smoke test | admin flows | M3-04,M3-05 | no | allowed/denied behavior correct | blocked | Requires runtime/browser smoke with allowed/denied admin roles; not executed in CLI. |
| M3-07 | Wire admin nav placeholders | `routes/web.php`, admin controllers/views, sidebar | M3-05,M4-* | no | real routes/controllers/views or intentional disabled UI; no `#` dead links for intended features | todo | **Nav gaps (2026-11-08, user-requested TODO):** admin sidebar placeholders `#` (manager-hidden where applicable): Users/Contacts/Admins/Roles/Permissions — no backing routes/controllers found. Blog Components placeholders — no backing admin routes found. Add routes/controllers/views or mark explicitly as planned/disabled in nav. |
| M5-01 | Add/update factories and seed placeholders | `database/factories`, `database/seeders` | M1-03,M4-* as needed | no | realistic placeholder records for key entities | todo | Use safe placeholder images/text. |
| M5-02 | Harden `DatabaseSeeder` behavior | `database/seeders/DatabaseSeeder.php` | M5-01 | no | clear, safe orchestration; no auto-run; docs aligned | done | Added permission-gated warning comments; removed unused import; `RolesAndPermissionsSeeder` intentionally excluded. Execution remains permission-gated. |

## Module 4 — Controllers & domain flows
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M4-01 | Implement KnowledgeBaseCategory admin CRUD | `Admin/KnowledgeBaseCategoryController`, routes/views | M0-01 | no | full functional CRUD + validation | done | Implemented controller + `admin.knowledge_base_categories.*` views; aligned `KnowledgeBaseCategories` model (`name/slug`, table, pivot). Routes added under `adminauth`. |
| M4-02 | Implement KnowledgeBase admin CRUD | `Admin/KnowledgeBaseController`, routes/views | M4-01 | no | full functional CRUD + relations/placeholders | done | Implemented controller + `admin.knowledge_bases.*` views with placeholder meta/content. Fixed `KnowledgeBases` pivot table/key names to match migrations (`knowledge_knowledge_base_*`, `kBase_categories_id`). |
| M4-03 | Implement KnowledgeBaseImage admin CRUD | `Admin/KnowledgeBaseImageController`, routes/views | M4-02 | no | full functional CRUD/upload or placeholder handling | done | Implemented controller + `admin.knowledge_base_images.*` views using URL/placeholder image handling (no external upload dependency required for local testing). |
| M4-04 | Make Dashboard useful | `Admin/DashboardController`, view | M0-01 | no | real/simulated safe aggregates render with empty DB | done | Replaced commented demo dashboard with safe aggregate counts/sums and recent bookings/payments; dashboard view handles empty states. |
| M4-05 | Audit all admin controllers | `app/Http/Controllers/Admin/*` | M3-05? | no | no stubs, actions functional, validation/errors sane | in_progress | KB/dashboard/show contracts fixed; admin mutations permission-middleware protected in routes+controllers; Mpesa callback hardened (idempotency/unknown checkout/safer metadata); Memes/Portfolio/Faqs odd `with()` view calls cleaned; `php -l` clean for app/config/routes/seeders. Remaining: full per-action validation/auth/404 sweep and untouched controllers. |
| M4-06 | Audit public/profile/payment controllers | `PagesController`, `UserController`, `MpesaController`, services | M2-05 | no | local-testable flows, graceful null/empty handling | in_progress | `MPESA_SIMULATE` centralized to config; bookingStore stray `DB::commit()` removed; Mpesa callback idempotency hardened; contact view shows validation errors; PagesController `with()` cleanup + `tutorial/education/portfolio` detail method naming normalized; `pages/portfolio_details` made safe placeholder (breadcrumb/back link). Remaining: full static/template debt, callback/runtime verification, user/payment edge cases. |
| M4-07 | Local payment simulation strategy | controllers/services/config/views | M4-06 | no | pending/completed flow testable without gateway | in_progress | Config-driven `services.mpesa.simulate` used in app; callback supports real gateway and has safer/idempotent handling; simulation notices present in touched waiting/status paths. Needs runtime verification (CLI blocked). |
| M5-03 | Global Blade empty-state pass | `resources/views/**` | M4-06 | no | no 500s on fresh/empty DB; helpful empty UI | in_progress | Targeted hardening on admin index/show/detail, profile/public contact, and mpesa payment detail; `@forelse`/alerts added where touched. Global `resources/views/**` sweep still pending. |
| M5-04 | Controller/view defensive null handling | controllers + views | M5-03 | no | `findOrFail`/optional/collection guards used appropriately | in_progress | Targeted `findOrFail`/`optional()`/null guards; appointments/portfolio/mpesa show hardened; chained relation access remains in 2 view spots (service images index, guarded by `@if`) — broader sweep pending. |

## Module 6 — UI/UX upgrade
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M6-01 | Confirm UI/UX depth | decision | M0-05 | no | 1/2/3 selected and recorded | done | Resolved as **2** (2026-11-08): moderate UI/UX upgrade. |
| M6-02 | UI conventions/shared patterns | layouts, partials, CSS/JS entrypoints | M6-01 | no | consistent forms/tables/cards/badges/alerts | in_progress | Added shared alert partials: `resources/views/layouts/partials/alerts.blade.php` (BS5/public) and `resources/views/admin/layouts/partials/alerts.blade.php` (admin theme) + admin layout injection. Remaining: shared table/form/card conventions across all CRUD screens. |
| M6-03 | Auth/profile/payment UX pass | auth/profile/bookings/payment views | M2-05,M6-02 | no | clearer flows, feedback, responsive basics | in_progress | Improved user register validation feedback/old input; admin login feedback copy/accessibility; profile/waiting/payment detail flows already hardened in prior passes. Remaining: full responsive/a11y pass on all auth/profile/payment screens. |
| M6-04 | Admin UX pass | admin layout/dashboard/CRUD views | M4-04,M4-05,M6-02 | no | navigable, clear actions, empty/loading/error states | in_progress | Admin layout now renders global alerts; dashboard has safe metrics/empty states; KB/nav/permission-aware actions added. Remaining: consistent forms/tables/cards/empty-loading across all CRUD views. |
| M6-05 | Public UX pass | home/catalog/portfolio/downloads/contact | M5-03,M6-02 | no | polished placeholders/empty states, consistent layout | in_progress | Contact shows validation errors; catalog/downloads/portfolio/comments received placeholder/empty-state hardening in prior passes. Remaining: consistent shared patterns and responsive polish across public key screens. |
| M6-06 | Accessibility/responsive sanity check | key screens | M6-03..M6-05 | no | labels, focus, contrast basics, mobile nav usable | todo | Lightweight pass unless depth=3. |

## Module 7 — Validation & handoff
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M7-01 | Static checks | touched PHP files | relevant modules | no | `php -l` clean; project tests/lint if available | in_progress | `php -l` run on touched files and across `app/config/routes/database/seeders` (clean). Project test/lint suite and full Blade/runtime checks not executed. |
| M7-02 | Permission-gated DB setup/seed smoke | local DB | M1-05,M1-06,M3-04 | **yes** | migrate/seed only with explicit permission | blocked | No permission granted in this session for seed/reseed/reset/destructive DB smoke. |
| M7-03 | End-to-end smoke flows | auth, guards, Spatie, CRUD, payments, UI | M7-01,M7-02 | no | key scenarios pass; residual risks listed | blocked | Requires runtime/browser + DB/app services; CLI-only pass cannot verify auth isolation, Spatie allow/deny, STK/callback/status, or UI flows. |
| M7-04 | Residual scan | codebase | M7-03 | no | no stubs, no `MustVerifyEmail` enforcement, no unsafe empty rendering in touched areas | in_progress | Touched stubs/show contracts/fallbacks fixed; `[0]` removed in touched views; global residual scan still pending. |

## Suggested first implementation slice (after decisions)
1. M0-02..M0-04 (docs/policies) — no permission gate.
2. M1-01..M1-04 (Postgres/env/migration audit) — no permission gate.
3. M2-01..M2-05 (email verification removal + guard-isolated logout + route cleanup).
4. Resolve M0-05 (Spatie A/B, UI/UX 1/2/3), then proceed into M3/M4/M5/M6 in small reviewable batches.
