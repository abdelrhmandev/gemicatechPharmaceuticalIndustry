<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function single($slug)
    {
        $compact = [
            'product' =>  Product::select('id','slug','title','image')->where('slug', $slug)->first(),
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
            'slug'     => $slug,
        ];

        return view('frontend.products.index', $compact);
    }
}
