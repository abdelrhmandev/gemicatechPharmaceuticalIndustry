<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function single($slug)
    {
        $compact = [
            'product' =>  Product::select('id','slug','title','image','brief','description')->where('slug', $slug)->firstOrfail(),
        ];
        return view('frontend.products.single', $compact);
    }

    public function prductsByCategory($slug)
    {
        $products = Product::whereHas('categories', function ($query) use ($slug) {
            $query->where('categories.slug', $slug);
        })->get();

        $compact = [
            'products' => $products,
            'slug'     => ucwords(str_replace('-', ' ', $slug)),
        ];

        return view('frontend.products.index', $compact);
    }
}
