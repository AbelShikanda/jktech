# DECISIONS.md — JKE

## Purpose
Record key decisions, rationale, and open items for the JKE local-dev migration/hardening work. See `doc/PLAN.md` and `doc/TASKS.md`.

## Resolved decisions

| Date | Decision | Rationale | Impact |
|---|---|---|---|
| 2026-11-08 | PostgreSQL is the local database target | MySQL servers are down for local work; app must remain testable locally | Update config/env/docs/migrations/query portability; validate migrations/seeds only with explicit permission |
| 2026-11-08 | Remove email verification for local environment | No free email testing provider available yet; verification blocks local testing | Remove/disable verification enforcement and UI prompts; keep `email_verified_at` harmless unless schema change is later approved |
| 2026-11-08 | Keep Laravel session/guard auth as source of truth | Existing stack is Laravel 8 + Blade + Laravel UI-style session guards; least disruptive path | Fix logout/redirect behavior per guard; do not add Sanctum/JWT in this pass |
| 2026-11-08 | Isolate client login/logout by guard | User logout currently logs out admin (and admin can affect shared session) | Guard-scoped logout, CSRF token regeneration as needed, guard-aware guest redirects, no full session flush for guard logout |
| 2026-11-08 | Git commits allowed; **no push** without explicit request | User requested commit capability but no automatic publishing | `AGENTS.md`/tasks enforce policy; pushes only on explicit user request |
| 2026-11-08 | Seeding/reseeding is permission-gated | Prevent accidental/destructive data changes | Never run `db:seed`, `migrate:fresh --seed`, `migrate:refresh --seed`, or destructive resets without explicit permission; mark tasks blocked until approved |
| 2026-11-08 | All DB-driven views must handle empty data gracefully | Fresh/partial DB states should be testable and not crash UI | Use `@forelse`, guards, placeholders, empty states, defensive controller checks |
| 2026-11-08 | Controllers must be complete/functional (no stubs) | Stubs block testing/admin workflows | Implement missing CRUD/actions, especially KnowledgeBase admin stubs and weak dashboard/payment/profile paths |
| 2026-11-08 | Use placeholders/simulation for local testing | External services/data may be unavailable | Safe placeholder images/content; explicit local payment simulation strategy (env/config gated) |
| 2026-11-08 | Project docs live in repo root / `doc/` | `.kilo/` removed at user request; plan moved | `AGENTS.md`, `GOALS.md`, `DECISIONS.md` at root; `doc/PLAN.md`, `doc/TASKS.md` in `doc/` |

## Open decisions (must resolve before affected implementation)

| ID | Question | Recommended | Options | Blocks |
|---|---|---|---|---|
| D-OPEN-01 | Spatie scope | **B** | **A)** replace app authentication/login with a Spatie package (high impact on Laravel 8 + dual guards; specify package). **B)** use Spatie Permission as authorization (roles/permissions/middleware/policies) on top of existing Laravel session/guard login. | M3 implementation depth/details |
| D-OPEN-02 | UI/UX depth | **2** | **1)** light polish. **2)** moderate upgrade (shared patterns, navigation/forms/tables/cards, responsive/accessibility pass on key screens). **3)** major redesign. | M6 scope/effort |

## Risks / notes
- **`.env` secret exposure risk:** local `.env` contains sensitive values (DB/M-Pesa credentials). Do not propagate or document secret values; recommend rotation outside the repo.
- **Session isolation nuance:** Laravel stores auth per guard, but full session invalidation and shared cookie behavior can create edge cases. Guard-scoped logout must be implemented carefully and smoke-tested; document any same-browser limitation.
- **Payment semantics:** current code marks some payments/bookings as completed. Local simulation must be explicit and env/config gated so it is not mistaken for production settlement.
- **KnowledgeBase alignment:** stub controllers and schema/route/view naming must align with actual models/tables (`knowledge_bases`, pivot/image/category tables) and admin UI patterns.
- **PostgreSQL compatibility:** review migrations for enum/unsigned/driver-specific assumptions and raw SQL portability before migration runs (permission-gated).
- **UI/UX scope creep:** keep changes modular and reviewable; avoid framework rewrite unless explicitly requested.

## Change log
- 2026-11-08: Initial decisions recorded from planning discussion and repo evidence.
- 2026-11-08: Module 1 (non-permission-gated) completed: `config/database.php` default changed to PostgreSQL (`env('DB_CONNECTION','pgsql')`); `.env.example` sanitized to PostgreSQL/log-mail/non-secret M-Pesa placeholders; migrations/raw-SQL audits completed with no active MySQL-specific runtime code found (commented dashboard `DB::raw` only; Spatie commented InnoDB engine only). Migration/seed execution remains permission-gated.
- 2026-11-08: Module 2 (M2-01..M2-05) implemented: local email verification removed from active auth path (`User` no longer uses `MustVerifyEmail`, kernel `verified` alias removed, `Auth::routes(['verify'=>false])`); guard-scoped logout added for `web` and `admin` (forget guard session key + `regenerateToken`, no full session invalidate/flush); `RedirectIfAuthenticated` now routes `admin` to dashboard and other authenticated guards to `RouteServiceProvider::HOME`; admin login routes guarded by `guest:admin`; duplicate `profile.update` route mapping removed and profile/subscription routes grouped under `auth:web`. Manual browser smoke test (M2-06) still pending.
