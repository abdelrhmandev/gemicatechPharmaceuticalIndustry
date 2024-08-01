<?php
namespace App\Http\Controllers\frontend;
use App\Models\Page;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index($slug = null)
    {
        $childcategories = Category::whereNotNull('parent_id');

        if ($slug) {
            $childcategories = $childcategories->whereHas('parent', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });

        }

        $compact = [
            'categories' => Category::select('id', 'title', 'parent_id', 'icon', 'slug', 'description')->whereNull('parent_id')->get()->take(4),
            'childcategories' => $childcategories->get(),
            'brands' => Brand::select('id', 'title', 'slug', 'image', 'description')->get(),
            'page' => Page::select('id', 'image')->where('id', '3')->firstorfail(),
            'slug' => $slug ?? '',
        ];

        return view('frontend.categories.index', $compact);
    }

    public function single($slug)
    {
        $compact = [
            'category' => Category::select('id', 'slug', 'title', 'image')->where('slug', $slug)->firstOrfail(),
        ];
        return view('frontend.categories.single', $compact);
    }
}
