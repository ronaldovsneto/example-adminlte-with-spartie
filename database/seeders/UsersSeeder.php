<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password'  => bcrypt('12345678'),
        ]);
        $admin->assignRole(config('permission')['super-admin']);

        $consultant = User::create([
            'name' => 'Consultant',
            'email' => 'consultant@consultant.com',
            'password'  => bcrypt('12345678'),
        ]);
        $consultant->assignRole('Consultant');

        User::create([
            'name' => 'Studant',
            'email' => 'studant@studant.com',
            'password'  => bcrypt('12345678'),
        ]);
    }
}
