<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        Permission::create(['name' => 'admin-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'admin-create','guard_name'=>'admin']);
        Permission::create(['name' => 'admin-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'menu-list','guard_name'=>'admin']);
        Permission::create(['name' => 'menu-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'menu-create','guard_name'=>'admin']);
        Permission::create(['name' => 'menu-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'setting-list','guard_name'=>'admin']);
        Permission::create(['name' => 'setting-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'setting-create','guard_name'=>'admin']);
        Permission::create(['name' => 'setting-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'category-list','guard_name'=>'admin']);
        Permission::create(['name' => 'category-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'category-create','guard_name'=>'admin']);
        Permission::create(['name' => 'category-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'product-list','guard_name'=>'admin']);
        Permission::create(['name' => 'product-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'product-create','guard_name'=>'admin']);
        Permission::create(['name' => 'product-edit','guard_name'=>'admin']);

        Permission::create(['name' => 'post-list','guard_name'=>'admin']);
        Permission::create(['name' => 'post-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'post-create','guard_name'=>'admin']);
        Permission::create(['name' => 'post-edit','guard_name'=>'admin']);



    }
}
