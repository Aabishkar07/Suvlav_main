<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(SettingSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $admin = User::create([
            'name' => 'Test User',
            'email' => 'admin@himalayanfabs.com',
            'password' => Hash::make('admin@123'),
            'usertype' => 'admin',
        ]);
        $this->call([
            PermissionSeeder::class
        ]);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $admin->assignRole("admin");

    }
}
