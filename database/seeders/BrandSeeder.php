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

        ['title'=>'CopleyPro','image'=>'uploads/brands/client-1.jpg'],
        ['title'=>'BrookFieldPro','image'=>'uploads/brands/client-2.jpg'],
        ['title'=>'EdmundBuhlerPro','image'=>'uploads/brands/client-3.jpg'],
        ['title'=>'HosokawaAlpinePro','image'=>'uploads/brands/client-4.jpg'],
        ['title'=>'HoribaPro','image'=>'uploads/brands/client-5.jpg'],
        ['title'=>'LabspherePro','image'=>'uploads/brands/client-6.jpg'],
        ['title'=>'RigakuPro','image'=>'uploads/brands/client-8.jpg'],
        ['title'=>'SmegPro','image'=>'uploads/brands/client-9.jpg'],
        ['title'=>'RudolphPro','image'=>'uploads/brands/client-10.jpg'],
        ['title'=>'ArcastPro','image'=>'uploads/brands/client-11.jpg'],
        ['title'=>'MemmrtPro','image'=>'uploads/brands/client-12.jpg'],
        ['title'=>'ShowrPro','image'=>'uploads/brands/client-13.jpg'],
      ]
    );


    }
}
