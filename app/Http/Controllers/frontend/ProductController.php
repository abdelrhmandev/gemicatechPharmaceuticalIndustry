<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function single($slug)
    {
    }

    public function prductsByCategory($slug)
    {
        $products = Product::whereHas('categories', function ($query) use ($slug) {
            $query->where('categories.slug', $slug);
        })->get();

        $compact = [
            'products' => $products,
        ];

        return view('frontend.products.index', $compact);
    }
}
