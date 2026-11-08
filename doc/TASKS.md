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
| M3-02 | Align Spatie Permission config/models | `config/permission.php`, `Admin`, `User` as needed, migrations | M3-01 | no | guards/cache/tables/traits coherent | todo | Avoid breaking current auth. |
| M3-03 | Define local roles/permissions map | seeders/docs | M3-02 | no | minimal useful roles/permissions for admin modules | todo | Placeholder/simulation-friendly. |
| M3-04 | Seed roles/permissions | seeders | M3-03 | **yes** | roles/permissions exist locally | blocked | Requires explicit user permission. |
| M3-05 | Protect admin actions | routes, controllers, middleware/policies | M3-02 | no | sensitive actions server-enforced | todo | UI hides/disables where practical. |
| M3-06 | Spatie smoke test | admin flows | M3-04,M3-05 | no | allowed/denied behavior correct | todo | |

## Module 4 — Controllers & domain flows
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M4-01 | Implement KnowledgeBaseCategory admin CRUD | `Admin/KnowledgeBaseCategoryController`, routes/views | M0-01 | no | full functional CRUD + validation | done | Implemented controller + `admin.knowledge_base_categories.*` views; aligned `KnowledgeBaseCategories` model (`name/slug`, table, pivot). Routes added under `adminauth`. |
| M4-02 | Implement KnowledgeBase admin CRUD | `Admin/KnowledgeBaseController`, routes/views | M4-01 | no | full functional CRUD + relations/placeholders | done | Implemented controller + `admin.knowledge_bases.*` views with placeholder meta/content. Fixed `KnowledgeBases` pivot table/key names to match migrations (`knowledge_knowledge_base_*`, `kBase_categories_id`). |
| M4-03 | Implement KnowledgeBaseImage admin CRUD | `Admin/KnowledgeBaseImageController`, routes/views | M4-02 | no | full functional CRUD/upload or placeholder handling | done | Implemented controller + `admin.knowledge_base_images.*` views using URL/placeholder image handling (no external upload dependency required for local testing). |
| M4-04 | Make Dashboard useful | `Admin/DashboardController`, view | M0-01 | no | real/simulated safe aggregates render with empty DB | done | Replaced commented demo dashboard with safe aggregate counts/sums and recent bookings/payments; dashboard view handles empty states. |
| M4-05 | Audit all admin controllers | `app/Http/Controllers/Admin/*` | M3-05? | no | no stubs, actions functional, validation/errors sane | in_progress | KB/dashboard/ServiceCategory/WorkSchedule/Faqs/Auth hardening done; admin CRUD routes moved under `/admin` + `adminauth`; dashboard refs aligned. Remaining admin controllers/views still need full validation + null/empty + Spatie server-side authorization pass. |
| M4-06 | Audit public/profile/payment controllers | `PagesController`, `UserController`, `MpesaController`, services | M2-05 | no | local-testable flows, graceful null/empty handling | in_progress | Local `MPESA_SIMULATE` added to touched payment/status paths; profile hardened; added `catalog()` and fixed `service($id)`/holidays API; created `pages.catalog` and DB-driven `pages.services` view. Broader public flow/runtime verification remains. |
| M5-03 | Global Blade empty-state pass | `resources/views/**` | M4-06 | no | no 500s on fresh/empty DB; helpful empty UI | in_progress | Targeted fixes: carousel/home/bookings/profile/downloads/catalog/services + multiple admin indexes (KB, holiday, appointments, bundles, subscriptions, payments, types, categories, workSchedule, faqs, memes, portfolio, software, services). Global sweep still pending. |

## Module 6 — UI/UX upgrade
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M6-01 | Confirm UI/UX depth | decision | M0-05 | no | 1/2/3 selected and recorded | done | Resolved as **2** (2026-11-08): moderate UI/UX upgrade. |
| M6-02 | UI conventions/shared patterns | layouts, partials, CSS/JS entrypoints | M6-01 | no | consistent forms/tables/cards/badges/alerts | todo | Stay compatible with Blade/Mix/Bootstrap unless justified. |
| M6-03 | Auth/profile/payment UX pass | auth/profile/bookings/payment views | M2-05,M6-02 | no | clearer flows, feedback, responsive basics | todo | |
| M6-04 | Admin UX pass | admin layout/dashboard/CRUD views | M4-04,M4-05,M6-02 | no | navigable, clear actions, empty/loading/error states | todo | |
| M6-05 | Public UX pass | home/catalog/portfolio/downloads/contact | M5-03,M6-02 | no | polished placeholders/empty states, consistent layout | todo | |
| M6-06 | Accessibility/responsive sanity check | key screens | M6-03..M6-05 | no | labels, focus, contrast basics, mobile nav usable | todo | Lightweight pass unless depth=3. |

## Module 7 — Validation & handoff
| ID | Title | Area/files | Deps | Permission gate | Validation | Status | Notes |
|---|---|---|---|---:|---|---|---|
| M7-01 | Static checks | touched PHP files | relevant modules | no | `php -l` clean; project tests/lint if available | todo | |
| M7-02 | Permission-gated DB setup/seed smoke | local DB | M1-05,M1-06,M3-04 | **yes** | migrate/seed only with explicit permission | blocked | |
| M7-03 | End-to-end smoke flows | auth, guards, Spatie, CRUD, payments, UI | M7-01,M7-02 | no | key scenarios pass; residual risks listed | todo | |
| M7-04 | Residual scan | codebase | M7-03 | no | no stubs, no `MustVerifyEmail` enforcement, no unsafe empty rendering in touched areas | todo | Document follow-ups. |

## Suggested first implementation slice (after decisions)
1. M0-02..M0-04 (docs/policies) — no permission gate.
2. M1-01..M1-04 (Postgres/env/migration audit) — no permission gate.
3. M2-01..M2-05 (email verification removal + guard-isolated logout + route cleanup).
4. Resolve M0-05 (Spatie A/B, UI/UX 1/2/3), then proceed into M3/M4/M5/M6 in small reviewable batches.
