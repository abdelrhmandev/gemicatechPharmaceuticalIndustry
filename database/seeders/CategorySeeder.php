<?php
namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('categories')->delete();

      DB::table('categories')->insert([

        [
            'title'=>'General Lab. Equipment',
            'slug'=>Str::slug('General Lab. Equipment'),
            'description'=>'Comprehensive range of measuring instruments for many specific testing applications.',
            'color'=>'#55a1d9',
            'created_at'=>Carbon::now()
        ],
        [
            'title'=>'Analytical & Measuring Instruments',
            'slug'=>Str::slug('Analytical & Measuring Instruments'),
            'description'=>'Indispensable for research, development, and quality control in a variety of fields.',
            'color'=>'#e54b62',
            'created_at'=>Carbon::now()
        ],
        [
            'title'=>'Production Machines',
            'slug'=>Str::slug('Production Machines'),
            'description'=>'Processes, form, shape, or transport raw materials, waste materials or finished products.',
            'color'=>'#8ce54b',
            'created_at'=>Carbon::now()
        ],
        [
            'title'=>'Material Processing',
            'slug'=>Str::slug('Material Processing'),
            'description'=>'Transform industrial materials from a raw-material state into finished parts or products.',
            'color'=>'#e54bce',
            'created_at'=>Carbon::now()
        ],
        ]);


    }
}
