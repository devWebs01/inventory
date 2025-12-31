<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call(ShieldSeeder::class);

        $faker = Faker::create();

        /**
         * 1. Pastikan role super_admin ada
         */
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        /**
         * 2. Buat / ambil user super admin
         */
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@testing.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        /**
         * 3. Assign role super_admin
         */
        if (!$superAdmin->hasRole('super_admin')) {
            $superAdmin->assignRole($superAdminRole);
        }

        /**
         * 4. Generate user lain untuk role selain super_admin
         */
        $roles = Role::where('name', '!=', 'super_admin')->get();

        foreach ($roles as $role) {
            for ($i = 0; $i < 10; $i++) {
                $user = User::create([
                    'firstname' => $faker->firstName,
                    'lastname' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]);

                $user->assignRole($role);
            }
        }
    }
}
