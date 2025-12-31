<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        /**
         * 1. Buat role super_admin dan admin
         */
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin'],
            ['guard_name' => 'web']
        );

        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['guard_name' => 'web']
        );

        /**
         * 2. Berikan semua hak akses kepada super_admin
         */
        $allPermissions = Permission::all();
        if ($allPermissions->isNotEmpty()) {
            $superAdminRole->syncPermissions($allPermissions);
        }

        /**
         * 3. Berikan hak akses kepada admin (kecuali pengguna dan hak akses)
         */
        $excludedPermissions = [
            'view_any_user',
            'view_user',
            'create_user',
            'update_user',
            'delete_user',
            'delete_any_user',
            'restore_user',
            'restore_any_user',
            'replicate_user',
            'reorder_user',
            'view_any_role',
            'view_role',
            'create_role',
            'update_role',
            'delete_role',
            'delete_any_role',
            'restore_role',
            'restore_any_role',
            'replicate_role',
            'reorder_role',
        ];

        $adminPermissions = Permission::whereNotIn('name', $excludedPermissions)->get();
        if ($adminPermissions->isNotEmpty()) {
            $adminRole->syncPermissions($adminPermissions);
        }

        /**
         * 4. Buat user super_admin
         */
        User::firstOrCreate(
            ['email' => 'admin@testing.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        )->assignRole($superAdminRole);

        /**
         * 5. Buat 5 user admin
         */
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(
                ['email' => "admin{$i}@testing.com"],
                [
                    'name' => "Admin {$i}",
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]
            )->assignRole($adminRole);
        }

        /**
         * 6. Generate user lain untuk role selain super_admin dan admin
         */
        $otherRoles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();

        foreach ($otherRoles as $role) {
            for ($i = 0; $i < 5; $i++) {
                User::create([
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ])->assignRole($role);
            }
        }
    }
}
