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


        // Permission::create(['name' => 'menu-list','guard_name'=>'admin']);
        // Permission::create(['name' => 'menu-delete','guard_name'=>'admin']);
        // Permission::create(['name' => 'menu-create','guard_name'=>'admin']);
        // Permission::create(['name' => 'menu-edit','guard_name'=>'admin']);

        Permission::create(['name' => 'page-list','guard_name'=>'admin']);
        Permission::create(['name' => 'page-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'page-create','guard_name'=>'admin']);
        Permission::create(['name' => 'page-edit','guard_name'=>'admin']);



        Permission::create(['name' => 'block-list','guard_name'=>'admin']);
        Permission::create(['name' => 'block-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'block-create','guard_name'=>'admin']);
        Permission::create(['name' => 'block-edit','guard_name'=>'admin']);



        Permission::create(['name' => 'category-list','guard_name'=>'admin']);
        Permission::create(['name' => 'category-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'category-create','guard_name'=>'admin']);
        Permission::create(['name' => 'category-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'product-list','guard_name'=>'admin']);
        Permission::create(['name' => 'product-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'product-create','guard_name'=>'admin']);
        Permission::create(['name' => 'product-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'industry-list','guard_name'=>'admin']);
        Permission::create(['name' => 'industry-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'industry-create','guard_name'=>'admin']);
        Permission::create(['name' => 'industry-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'brand-list','guard_name'=>'admin']);
        Permission::create(['name' => 'brand-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'brand-create','guard_name'=>'admin']);
        Permission::create(['name' => 'brand-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'slider-list','guard_name'=>'admin']);
        Permission::create(['name' => 'slider-delete','guard_name'=>'admin']);
        Permission::create(['name' => 'slider-create','guard_name'=>'admin']);
        Permission::create(['name' => 'slider-edit','guard_name'=>'admin']);


        Permission::create(['name' => 'setting-list','guard_name'=>'admin']);



    }
}
