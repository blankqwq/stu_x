<?php

use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 重置角色和权限的缓存
        app()['cache']->forget('spatie.permission.cache');

        // 创建权限
        Permission::create(['name' => 'edit/class']);
        Permission::create(['name' => 'edit/user']);
        Permission::create(['name' => 'edit/web']);
        Permission::create(['name' => 'edit/file']);

        // 创建角色并赋予权限
        $role = Role::create(['name' => 'master']);
        $role->givePermissionTo('edit/class');
        $role->givePermissionTo('edit/user');
        $role->givePermissionTo('edit/web');
        $role->givePermissionTo('edit/file');
        
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('edit/class');
        $role->givePermissionTo('edit/user');
        $role->givePermissionTo('edit/file');



    }
}
