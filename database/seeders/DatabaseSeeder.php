<?php

namespace Database\Seeders;

use App\Models\Mosque;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Congregation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Seeders\Permission\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if the user exists

        $mosque = Mosque::firstOrCreate(['name' => 'Masjid Jami Aliyah'], ['name' => 'Masjid Jami Aliyah', 'phone' => 'XXXXXXX', 'address' => 'XXXXXXX']);

        $role = Role::firstOrCreate(
            ['name' => 'Administrator', 'guard_name' => 'web'],
            ['name' => 'Administrator', 'guard_name' => 'web']
        );
        $user = User::where('email', 'muhamad.muslih@alkhumasi.id')->first();
        $congregation = Congregation::where('name', 'Muhamad Muslih')->first();


        if (!$congregation) {
            $congregation = Congregation::create([
                'name' => 'Muhamad Muslih',
                'code' => 'XXXXXXXX',
                'no_ktp' => 'XXXXXXXX',
                'pob' => 'Karawang',
                'dob' => '1995-10-07',
                'address' => 'Kepuh Karawang',
                'phone' => 'XXXXXXXX',
                'gender' => 'Laki-laki',
                'role_id' => $role->id,
                'mosque_id' => $mosque->id,
            ]);
        }

        if (!$user) {
            // If user doesn't exist, create a new user
            $user = User::create([
                'name' => 'Muhamad Muslih',
                'email' => 'muhamad.muslih@alkhumasi.id',
                'email_verified_at' => now(),
                'password' => Hash::make('admin@2024!'),
                'remember_token' => Str::random(10),
                'congregation_id' => $congregation->id
            ]);
        }

        // Create or find the 'administrator' role


        // Run the PermissionSeeder
        $this->call([
            //PermissionSeeder::class
        ]);

        // Fetch all permissions created by PermissionSeeder
        $permissions = Permission::pluck('name')->toArray();

        // Assign all the permissions to the 'administrator' role
        $role->syncPermissions($permissions); // syncPermissions to assign the fetched permissions

        // Assign or sync the role to the user
        if ($user) {
            $user->syncRoles([$role]); // Sync roles to avoid duplicates
        }
    }
}
