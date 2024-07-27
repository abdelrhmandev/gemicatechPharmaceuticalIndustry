<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // create roles and assign created permissions

        Permission::create(['name' => 'admin-list','guard_name'=>'admin']);




        $role = Role::create(['name' => 'Administrator','guard_name'=>'admin']);
        $role->givePermissionTo(Permission::all());

        ///////////////////

        $role = Role::create(['name' => 'Editor','guard_name'=>'admin']);
        $role->givePermissionTo('category-create')
        ->givePermissionTo(['product-list']);


        $role = Role::create(['name' => 'Writer','guard_name'=>'admin']);
        $role->givePermissionTo('product-create')
        ->givePermissionTo(['product-list'])
        ->givePermissionTo(['post-list']);

        $role = Role::create(['name' => 'Data Entry','guard_name'=>'admin']);
        $role->givePermissionTo('category-create')
        ->givePermissionTo(['product-list']);


        $role = Role::create(['name' => 'Contributor','guard_name'=>'admin']);
        $role->givePermissionTo('setting-create')
        ->givePermissionTo(['setting-list']);



    }
}
