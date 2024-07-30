<?php

namespace App\Http\Controllers\frontend;
use App\Models\Page;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'sliders'   => Slider::select('id', 'title', 'description', 'image', 'link')->get(),
            'categories' => Category::select('id', 'title', 'parent_id', 'icon', 'slug', 'description')->whereNull('parent_id')->get()->take(4),
            'industries' => Industry::select('id', 'title', 'image', 'color', 'icon', 'slug', 'description')->get(),
            'brands'    => Brand::select('id', 'title', 'slug', 'image', 'description')->get(),
            'about'    => Page::select('id','title','description','image','slug')->find('1'),
        ];


        return view('frontend.home', $data);
    }
}
