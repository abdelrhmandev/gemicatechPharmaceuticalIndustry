<?php
namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('categories')->whereNotNull('parent_id')->delete();

      DB::table('categories')->insert([

        // Parent Id = 1
        ['title'=>'Shakers','slug'=>str::slug('Shakers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'PH Meters / Conductivity Meters','slug'=>str::slug('PH Meters / Conductivity Meters'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Dissolution Testers','slug'=>str::slug('Dissolution Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Disintegration Testers','slug'=>str::slug('Disintegration Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Hardness Testers','slug'=>str::slug('Hardness Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],

        ['title'=>'Tap Density Testers','slug'=>str::slug('Tap Density Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Friability Testers','slug'=>str::slug('Friability Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Semi Solid Testers','slug'=>str::slug('Semi Solid Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Suppository Testers','slug'=>str::slug('Suppository Testers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Refrigerators','slug'=>str::slug('Refrigerators'),'parent_id'=>'1','created_at'=>Carbon::now()],

        ['title'=>'Freezers','slug'=>str::slug('Freezers'),'parent_id'=>'1','created_at'=>Carbon::now()],
        // ['title'=>'Production Machines','slug'=>str::slug('Production Machines'),'parent_id'=>'1','created_at'=>Carbon::now()],
        ['title'=>'Lab Glassware Washers','slug'=>str::slug('Lab Glassware Washers'),'parent_id'=>'1','created_at'=>Carbon::now()],

        /// Parent Id 2


        ['title'=>'Handheld Raman Analyzers','slug'=>str::slug('Handheld Raman Analyzers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Polarimeters','slug'=>str::slug('Polarimeters'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Refractometers','slug'=>str::slug('Refractometers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Liquid Density Meters','slug'=>str::slug('Liquid Density Meters'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Air Jet Sievers','slug'=>str::slug('Air Jet Sievers'),'parent_id'=>'2','created_at'=>Carbon::now()],

        ['title'=>'Inhalation device Testers','slug'=>str::slug('Inhalation device Testers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Viscometer & Rheometers','slug'=>str::slug('Viscometer & Rheometers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Texture Analyzers','slug'=>str::slug('Texture Analyzers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Integrating Sphere Spectroradiometers','slug'=>str::slug('Integrating Sphere Spectroradiometers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'LED Characterization Systems','slug'=>str::slug('LED Characterization Systems'),'parent_id'=>'2','created_at'=>Carbon::now()],

        ['title'=>'Sun Screen Ultraviolet Transmittance Analyzers','slug'=>str::slug('Sun Screen Ultraviolet Transmittance Analyzers'),'parent_id'=>'2','created_at'=>Carbon::now()],
        ['title'=>'Digital UVC Irradiance Meters','slug'=>str::slug('Digital UVC Irradiance Meters'),'parent_id'=>'2','created_at'=>Carbon::now()],

        /// Parent Id 3
        ['title'=>'Blenders & Mixers','slug'=>str::slug('Blenders & Mixers'),'parent_id'=>'3','created_at'=>Carbon::now()],
        ['title'=>'Classifiers (Hosokawa Micron)','slug'=>str::slug('Classifiers (Hosokawa Micron)'),'parent_id'=>'3','created_at'=>Carbon::now()],
        ['title'=>'Containment Solutions','slug'=>str::slug('Containment Solutions'),'parent_id'=>'3','created_at'=>Carbon::now()],

        /// Parent Id 4
        ['title'=>'Arc Melters','slug'=>str::slug('Arc Melters'),'parent_id'=>'4','created_at'=>Carbon::now()],
        ['title'=>'Induction Ceramic and Graphite Crucible Melters','slug'=>str::slug('Induction Ceramic and Graphite Crucible Melters'),'parent_id'=>'4','created_at'=>Carbon::now()],
        ['title'=>'Cold Crucible and Ceramic Furnace Atomization','slug'=>str::slug('Cold Crucible and Ceramic Furnace Atomization'),'parent_id'=>'4','created_at'=>Carbon::now()],



        ]);




    }
}
