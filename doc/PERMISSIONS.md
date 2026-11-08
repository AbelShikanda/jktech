# Admin Permissions Matrix (M3)

Source of truth (seeder): `database/seeders/RolesAndPermissionsSeeder.php` (guard `admin`, **permission-gated** to run).  
Route enforcement: `routes/web.php` (admin mutations behind `permission:<name>,admin`; reads behind `adminauth`).

| Permission | Role mapping (seeder) | Admin modules / routes (mutations) | Notes |
|---|---|---|---|
| `admin.dashboard.view` | super-admin, manager, viewer | `/admin/dashboard` | Access via `adminauth`; refine to permission middleware if dashboard becomes sensitive. |
| `admin.services.manage` | super-admin, manager | `types`, `service_categories`, `services`, service images, `bundles`, `software` (non-index/show) | Index/show readable by authorized admins. |
| `admin.bookings.manage` | super-admin, manager | `user-bundles` mutations, `appointments` edit/update | Appointments index/show readable. |
| `admin.payments.view` | super-admin, manager, viewer | `payments` mutations/export currently gated by this permission (see risk) | **Risk:** export/mutations are sensitive; consider `admin.payments.manage` for write/export. |
| `admin.content.manage` | super-admin, manager | `knowledge-base-*`, `faqs`, `portfolios`, `memes` (non-index/show) | KB routes added to sidebar (`acd9173`). |
| `admin.settings.manage` | super-admin, manager | `work` schedules, `holiday` (non-index/show) | Sidebar schedules section hidden unless permitted. |
| `admin.users.view` | super-admin, manager | Reserved (no dedicated routes yet) | Wire when user/admin/contact/role mgmt routes are added. |

## UI reflection (partial)
- `resources/views/admin/layouts/sidebar.blade.php`: `$can($perm)` helper; schedules hidden by `admin.settings.manage`; User Components/User Management hidden by manager/super-admin heuristic.
- Remaining: add `@can`/disable/hide on per-action buttons (create/edit/delete/export) in index/show views.

## Smoke matrix (M3-06, blocked in CLI)
Run with real browser sessions (guard isolation M2-06 also required):

| Role | Expect allowed | Expect denied (403/redirect as configured) |
|---|---|---|
| super-admin | all admin mutations/exports | — |
| manager | services/bookings/content/settings + payments.view-gated actions | future admin.users/admin-only actions |
| viewer | dashboard/payments read as permitted | services/content/settings/bookings mutations, exports if gated to manage |
| web user | public/user routes only | all `/admin/*` |

**Blockers:** browser/runtime required; verify after seeder run (permission-gated) and with session-cookie isolation behavior.
