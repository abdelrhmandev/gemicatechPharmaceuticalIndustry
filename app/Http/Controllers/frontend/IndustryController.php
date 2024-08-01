<?php
namespace App\Http\Controllers\frontend;
use App\Models\Brand;
use App\Models\Industry;
use App\Http\Controllers\Controller;

class IndustryController extends Controller
{

    public function index(){
        $compact = [
            'industries' =>  Industry::select('id','slug','title','color','image')->get(),
            'brands'    => Brand::select('id', 'title', 'slug', 'image', 'description')->get(),
        ];
        return view('frontend.industries.index', $compact);

    }

    public function single($slug){
        $compact = [
            'industry' =>  Industry::select('id','slug','title','image')->where('slug', $slug)->firstOrfail(),
        ];
        return view('frontend.industries.single', $compact);

    }
}
