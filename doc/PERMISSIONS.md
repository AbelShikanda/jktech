# Admin Permissions Matrix (M3)

Source of truth (seeder): `database/seeders/RolesAndPermissionsSeeder.php` (guard `admin`, **permission-gated** to run).  
Route enforcement: `routes/web.php` (`permission:<name>,admin` on admin mutation groups; reads behind `adminauth`).  
Controller defense-in-depth: admin CRUD controllers use constructor middleware and action-level `abort_unless(auth('admin')->user()?->can(...), 403)` on mutating actions.  
UI reflection: Blade `@can` / permission helpers on admin index/show/create/edit actions.

| Permission | Role mapping (seeder) | Admin modules / routes | Notes |
|---|---|---|---|
| `admin.dashboard.view` | super-admin, manager, viewer | `/admin/dashboard` | Access via `adminauth`; refine to permission middleware if dashboard becomes sensitive. |
| `admin.services.manage` | super-admin, manager | `types`, `service_categories`, `services`, service images, `bundles`, `software` (mutations) | Index/show readable by authorized admins. |
| `admin.bookings.manage` | super-admin, manager | `user-bundles` mutations, `appointments` edit/update | Appointments index/show readable. |
| `admin.payments.view` | super-admin, manager, viewer | `payments` index/show (read) | **Read-only intent** for viewers. |
| `admin.payments.manage` | super-admin, manager | `payments` create/store/edit/update/destroy/export (mutations) | Split implemented + seeded (2026-11-08, explicit DB permission). Viewers must not mutate/export. |
| `admin.content.manage` | super-admin, manager | `knowledge-base-*`, `faqs`, `portfolios`, `memes` (mutations) | KB routes present in sidebar. |
| `admin.settings.manage` | super-admin, manager | `work` schedules, `holiday` (mutations) | Sidebar schedules hidden unless permitted. |
| `admin.users.view` | super-admin, manager | Reserved (no dedicated routes yet) | Wire when user/admin/contact/role mgmt routes are added (M3-07 planned nav items). |

## UI reflection
- `resources/views/admin/layouts/sidebar.blade.php`: permission-aware helpers; schedules hidden by `admin.settings.manage`; User/Role management placeholders marked planned (M3-07), manager-hidden.
- Admin index/show/create/edit views use `@can`/permission checks for mutating actions (create/edit/delete/export) where implemented.
- Remaining: formal per-model Laravel policies are optional (current defense uses route+constructor+action checks+UI).

## Smoke matrix (M3-06, blocked in CLI)
Run with real browser sessions (guard isolation M2-06 also required):

| Role | Expect allowed | Expect denied (403/redirect as configured) |
|---|---|---|
| super-admin | all admin mutations/exports | — |
| manager | services/bookings/content/settings/payments.manage actions | future admin.users/admin-only actions |
| viewer | dashboard + payments read (`admin.payments.view`) | services/content/settings/bookings mutations, payments mutations/export (`admin.payments.manage`) |
| web user | public/user routes only | all `/admin/*` |

**Blockers:** browser/runtime required; verify after seeder run (permission-gated) and with session-cookie isolation behavior.
