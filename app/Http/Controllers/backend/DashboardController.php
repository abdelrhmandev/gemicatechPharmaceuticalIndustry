<?php
namespace App\Http\Controllers\backend;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
        'admins_counter'         => Admin::count(),
        'products_counter'       => Product::count(),
        'categories_counter'     => Category::count(),
        'brands_counter'         => Brand::count(),
        ];
        return view('backend.dashboard',$data);
    }
}
