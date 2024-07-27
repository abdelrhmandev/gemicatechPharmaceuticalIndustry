<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $this->call([PermissionSeeder::class, RoleSeeder::class, AdminSeeder::class, BlockSeeder::class, CategorySeeder::class, SubCategorySeeder::class, PageSeeder::class, SliderSeeder::class, IndustrySeeder::class, BrandSeeder::class, ProductSeeder::class, SocialNetworkSeeder::class, SettingSeeder::class]);
    }
}
