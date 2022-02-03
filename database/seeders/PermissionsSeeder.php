<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::findByName( 'Consultant', 'web');
        $list = [
            [
                'name' => 'user_list',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user_show',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user_edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user_add',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user_delete',
                'guard_name' => 'web',
            ]
        ];
        foreach ($list as $item){
            $permission = Permission::create($item);
            $role->givePermissionTo($permission);
        }
    }
}
