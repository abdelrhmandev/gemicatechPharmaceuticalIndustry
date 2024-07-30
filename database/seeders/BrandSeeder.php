<?php
namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->delete();

        DB::table('brands')->insert([
            ['title' => 'CopleyPro', 'slug' => str::slug('CopleyPro'), 'image' => 'uploads/brands/client-1.png'],
            ['title' => 'BrookFieldPro', 'slug' => str::slug('BrookFieldPro'), 'image' => 'uploads/brands/client-2.png'],
            ['title' => 'EdmundBuhlerPro', 'slug' => str::slug('EdmundBuhlerPro'), 'image' => 'uploads/brands/client-3.png'],
            ['title' => 'HosokawaAlpinePro', 'slug' => str::slug('HosokawaAlpinePro'), 'image' => 'uploads/brands/client-4.png'],
            ['title' => 'HoribaPro', 'slug' => str::slug('HoribaPro'), 'image' => 'uploads/brands/client-5.png'],
            ['title' => 'LabspherePro', 'slug' => str::slug('LabspherePro'), 'image' => 'uploads/brands/client-6.png'],
            ['title' => 'Laqua', 'slug' => str::slug('Laqua'), 'image' => 'uploads/brands/client-7.png'],
            ['title' => 'RigakuPro', 'slug' => str::slug('RigakuPro'), 'image' => 'uploads/brands/client-8.png'],
            ['title' => 'SmegPro', 'slug' => str::slug('SmegPro'), 'image' => 'uploads/brands/client-9.png'],
            ['title' => 'RudolphPro', 'slug' => str::slug('RudolphPro'), 'image' => 'uploads/brands/client-10.png'],
            ['title' => 'ArcastPro', 'slug' => str::slug('ArcastPro'), 'image' => 'uploads/brands/client-11.png'],
            ['title' => 'MemmrtPro', 'slug' => str::slug('MemmrtPro'), 'image' => 'uploads/brands/client-12.png'],
            ['title' => 'ShowrPro', 'slug' => str::slug('ShowrPro'), 'image' => 'uploads/brands/client-13.png'],
        ]);
    }
}
