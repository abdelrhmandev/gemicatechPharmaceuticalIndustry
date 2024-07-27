<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SliderSeeder extends Seeder
{
    public function run(){
        DB::table('sliders')->delete();





        DB::table('sliders')->insert([
            ['title'=>'Pharmaceutical Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/1.jpg'],
            ['title'=>' Oil & Gas Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/2.jpg'],
            ['title'=>'Fragrance & Flavour Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/3.jpg'],
            ['title'=>'Sugar Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/4.jpg'],
            ['title'=>'Food & Beverage Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/5.jpg'],
            ['title'=>'Cosmetics Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/6.jpg'],
            ['title'=>'Material Processing Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/7.jpg'],
            ['title'=>'Light Measurement Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/8.jpg'],
            ['title'=>'Environment & Energy Industry','description'=>'Providing High-Quality Laboratory Instruments & Machinery for the','image'=>'uploads/sliders/9.jpg'],

        ]);


    }
}
