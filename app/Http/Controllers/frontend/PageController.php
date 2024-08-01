<?php

namespace App\Http\Controllers\frontend;
use App\Models\Page;
use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

        public function single($slug){


            $page = Page::select('id','title','description','image','sub_title','template')->where('slug', $slug)->firstorfail();

            $view = $page->template ? 'templates.'.$page->template : 'single';

            $compact = [
                'page' =>   $page,
            ];


        return view('frontend.pages.'.$view, $compact);
    }
}
