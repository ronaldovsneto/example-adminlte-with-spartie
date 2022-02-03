<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'name' => 'Consultant',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Student',
                'guard_name' => 'web',
            ],
            [
                'name' => config('permission')['super-admin'],
                'guard_name' => 'web',
            ],
        ];
        foreach ($list as $item){
            Role::create($item);
        }
    }
}
