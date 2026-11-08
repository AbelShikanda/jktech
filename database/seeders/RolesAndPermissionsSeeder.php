<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Local/dev role & permission seed data (Spatie Permission, admin guard).
 *
 * PERMISSION-GATED: Do not run without explicit user permission.
 * Not called from DatabaseSeeder by default. Run manually only when approved:
 *   php artisan db:seed --class=RolesAndPermissionsSeeder --force
 */
class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'admin';

        $permissions = [
            'admin.dashboard.view',
            'admin.services.manage',
            'admin.bookings.manage',
            'admin.payments.view',
            'admin.payments.manage',
            'admin.users.view',
            'admin.content.manage',
            'admin.settings.manage',
        ];

        foreach ($permissions as $name) {
            Permission::findOrCreate($name, $guard);
        }

        $super = Role::findOrCreate('super-admin', $guard);
        $super->syncPermissions($permissions);

        $manager = Role::findOrCreate('manager', $guard);
        $manager->syncPermissions([
            'admin.dashboard.view',
            'admin.services.manage',
            'admin.bookings.manage',
            'admin.payments.view',
            'admin.payments.manage',
            'admin.content.manage',
            'admin.settings.manage',
        ]);

        $viewer = Role::findOrCreate('viewer', $guard);
        $viewer->syncPermissions(['admin.dashboard.view', 'admin.payments.view']);
    }
}
