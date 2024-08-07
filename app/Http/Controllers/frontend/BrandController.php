<?php
namespace App\Http\Controllers\frontend;
use App\Models\Page;
use App\Models\Brand;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{


    public function single($slug){

        $compact = [
            'brand' =>  Brand::select('id','slug','title','image')->where('slug', $slug)->firstOrfail(),
        ];
        return view('frontend.brands.single', $compact);

    }
}
