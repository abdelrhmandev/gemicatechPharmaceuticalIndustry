<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{


    public function single($slug){
        $compact = [
            'brand' =>  Brand::select('id','slug','title','image')->where('slug', $slug)->first(),
        ];
        return view('frontend.brands.single', $compact);

    }
}
