<?php
namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('industries')->delete();

      DB::table('industries')->insert([

        ['title'=>'Pharmaceuticals',
            'slug'=>Str::slug('Pharmaceuticals'),
            'image'=>'uploads/industries/pharmaceuticals.jpg',
            'color'=>'#55a1d9',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Oil & Gas',
            'slug'=>Str::slug('Oil & Gas'),
            'image'=>'uploads/industries/oil-gas.jpg',
            'color'=>'#e54b62',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Fragrance & Flavour',
            'slug'=>Str::slug('Production Machines'),
            'image'=>'uploads/industries/fragrance.jpg',
            'color'=>'#8ce54b',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Sugar',
            'slug'=>Str::slug('Sugar'),
            'image'=>'uploads/industries/sugar.jpg',
            'color'=>'#e54bce',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Food & Beverage',
            'slug'=>str::slug('Food & Beverage'),
            'image'=>'uploads/industries/food-beverage.jpg',
            'color'=>'#8ce54b',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Cosmetics',
            'slug'=>str::slug('Cosmetics'),
            'image'=>'uploads/industries/cosmetics.jpg',
            'color'=>'#8ce54b',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Material Processing',
            'slug'=>str::slug('Material Processing'),
            'image'=>'uploads/industries/material-pro.jpg',
            'color'=>'#8ce54b',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Light Measurement',
            'slug'=>str::slug('Light Measurement'),
            'image'=>'uploads/industries/light-measurement.jpg',
            'color'=>'#8ce54b',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ],[
            'title'=>'Environment & Energy',
            'slug'=>str::slug('Environment & Energy'),
            'image'=>'uploads/industries/environment-energy.jpg',
            'color'=>'#8ce54b',
            'description'=>'To determine product purity by measuring specific rotation and optical rotation',
            'created_at'=>Carbon::now()
        ]
      ]
    );


    }
}
