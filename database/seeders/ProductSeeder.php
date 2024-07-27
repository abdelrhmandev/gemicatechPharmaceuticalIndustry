<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('products')->delete();


        DB::table('products')->insert([

            ['title'=>'AP IZ / AP IIZ / AP 880T','slug'=>Str::slug('AP IZ / AP IIZ / AP 880T'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'1'],
            ['title'=>'Refractometer J-157 Plus HA , J-157 Plus WR, J-157 PTW','slug'=>Str::slug('Refractometer J-157 Plus HA , J-157 Plus WR, J-157 PTW'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'2'],
            ['title'=>'Universal Oven U','slug'=>Str::slug('Universal Oven U'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'3'],
            ['title'=>'illumia®Plus2','slug'=>Str::slug('illumia®Plus2'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'4'],
            ['title'=>'LAQUA 1500','slug'=>Str::slug('LAQUA 1500'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'5'],
            ['title'=>'Cold Crucible and Ceramic Furnace Atomization ','slug'=>Str::slug('Cold Crucible and Ceramic Furnace Atomization '),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'6'],
            ['title'=>'Gas Atomizer','slug'=>Str::slug('Gas Atomizer'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'7'],
            ['title'=>'C and SMF Series','slug'=>Str::slug('C and SMF Series'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'8'],
            ['title'=>'GW0160-GW2145-GW1160-GW4060-GW4190','slug'=>Str::slug('GW0160-GW2145-GW1160-GW4060-GW4190'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'8'],
            ['title'=>'SDT 1000','slug'=>Str::slug('SDslug0'),'brief'=>' During the course of a distinguished 35-year track record, General Manager Hany Gamil, founder of Gemica engineering established in 2002, has consistently achieved customer satisfaction through the delivery of reliable expert services and product range. Expanding the business with Gemicatech in 2002, the company provides cutting-edge analytical Instruments, machinery & solutions for the Egyptian market. ','brand_id'=>'10'],
        ]);

        DB::table('product_category')->insert([

            ['product_id'=>'1','category_id'=>'1'],
            ['product_id'=>'1','category_id'=>'2'],
            ['product_id'=>'1','category_id'=>'11'],
            ['product_id'=>'1','category_id'=>'12'],
            ['product_id'=>'2','category_id'=>'1'],
            ['product_id'=>'3','category_id'=>'2'],
            ['product_id'=>'3','category_id'=>'1'],
        ]);

        DB::table('product_industry')->insert([
            ['product_id'=>'1','industry_id'=>'1'],
            ['product_id'=>'1','industry_id'=>'2'],
            ['product_id'=>'1','industry_id'=>'5'],
            ['product_id'=>'1','industry_id'=>'6'],
            ['product_id'=>'2','industry_id'=>'8'],
            ['product_id'=>'3','industry_id'=>'4'],
            ['product_id'=>'3','industry_id'=>'2'],
        ]);



    }
}
