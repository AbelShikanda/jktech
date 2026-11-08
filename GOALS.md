# GOALS.md — JKE

## Context
JKE is a Laravel 8 Blade/Mix application with separate `web` (user) and `admin` guards, Spatie Permission installed, and domain features around services, bookings, subscriptions/bundles, payments (M-Pesa integration points), downloads/software, portfolio/content, and admin management. The codebase currently targets MySQL, has local-development gaps (email verification friction, logout session collision between guards, stub/incomplete controllers, unsafe empty-data rendering in places, and hardcoded payment completion paths), and lacks a modulated execution board/policy docs.

## Primary goals
1. **PostgreSQL local readiness**
   - Make PostgreSQL the documented/supported local database target.
   - Keep migrations and data-access code portable and compatible.

2. **Local authentication without email verification friction**
   - Remove email verification requirements/flows for local development until a free provider is available.
   - Keep registration/login/profile flows usable locally.

3. **Isolated user/admin sessions**
   - Fix logout/session behavior so user logout does not terminate the admin session and admin logout does not terminate the user session.
   - Preserve CSRF and guard-correct routing/redirect behavior.

4. **Spatie authorization done right for this stack**
   - Use Spatie Permission consistently for authorization (roles/permissions) on top of existing Laravel session/guard authentication.
   - Enforce authorization on the server; reflect permissions in UI where practical.

5. **Complete, functional controllers**
   - Replace stubs with working implementations.
   - Ensure admin controllers (including KnowledgeBase-related and dashboard/profile-adjacent flows) are functional and testable with placeholders/simulated data.
   - Make payment/subscription/booking flows locally testable with explicit simulation behavior.

6. **Graceful empty-data handling**
   - All database-driven views/sections must render safely with no records, null relations, or partial data.
   - Provide clear empty states and placeholder content where appropriate.

7. **UI/UX upgrade**
   - Improve clarity, consistency, feedback, and responsiveness across key public and admin screens.
   - Keep the upgrade modular and compatible with the existing Blade/Mix stack.

8. **Safe operational policies**
   - Enforce: local git commits allowed, **never push** without explicit user request.
   - Enforce: **never seed/reseed or run destructive DB reset actions without explicit user permission**.

## Success criteria
- App configuration/docs support PostgreSQL local setup without embedded secrets.
- No email verification blocks local registration/login/profile use.
- Guard-scoped logout preserves the other guard’s session in supported local workflows (limitations documented if any).
- Spatie-protected admin actions are server-enforced.
- No controller stubs in targeted modules; CRUD/pages render and behave sensibly.
- Fresh/empty database state does not crash database-driven pages; empty states are visible and helpful.
- `AGENTS.md`, `GOALS.md`, `DECISIONS.md`, and `doc/TASKS.md` are present, structured, and aligned.
- All permission-gated DB actions remain blocked unless explicitly approved by the user.
