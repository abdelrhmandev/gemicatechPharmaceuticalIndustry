<?php
namespace App\Http\Controllers\backend;
use DataTables;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Industry;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use App\Models\ProductMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\backend\ProductRequest;

class SettingController extends Controller
{
    public function index(Request $request){

    }
}
