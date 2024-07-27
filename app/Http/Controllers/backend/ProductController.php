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

class ProductController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.products';
        $this->TRANS = 'product';
        $this->UPLOADFOLDER = 'products';
    }

    public function index(Request $request)
    {
        $model = Product::select('id', 'title', 'image', 'brand_id', 'created_at')->with(['brand', 'categories']);
        if ($request->ajax()) {
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('title', function ($row) {
                    return '<a href=' . route($this->ROUTE_PREFIX . '.edit', $row->id) . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" . $row->id . "=\"item\">" . $row->title . '</a>';
                })
                ->editColumn('brand_id', function ($row) {
                    return '<a href=' . route('admin.brands.edit', $row->brand_id) . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" . $row->brand_id . "=\"item\">" . $row->brand->title . '</a>';
                })
                ->addColumn('categories', function (Product $row) {
                    $categories = '';
                    if (count($row->categories)) {
                        foreach ($row->categories as $value) {
                            $categories .= "<a href=\"" . route('admin.categories.edit', $value->id) . "\"   title=\"" . $value->title . "\">" . $value->title . '</a> ,';
                        }
                        $categories = substr($categories, 0, -2);
                    } else {
                        $categories = '<span aria-hidden="true">—</span>';
                    }
                    return $categories;
                })
                ->editColumn('image', function ($row) {
                    return $this->dataTableGetImage($row, $this->ROUTE_PREFIX . '.edit');
                })

                ->editColumn('created_at', function ($row) {
                    return $this->dataTableGetCreatedat($row->created_at);
                })

                ->editColumn('actions', function ($row) {
                    return $this->dataTableEditRecordAction($row, $this->ROUTE_PREFIX);
                })

                ->rawColumns(['image', 'title', 'brand_id', 'actions', 'categories', 'created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.products.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.products.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.products.create')) {
            $compact = [
                'categories' => Category::whereNull('parent_id')->withCount('children')->get(),
                'industries' => Industry::select('id', 'title')->get(),
                'brands' => Brand::select('id', 'title')->get(),
                'trans' => $this->TRANS,
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.products.create', $compact);
        }
    }
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $validated['slug'] = Str::slug($validated['title']);
            $validated['image'] = !empty($validated['image']) ? $this->uploadFile($validated['image'], $this->UPLOADFOLDER) : null;

            $product = Product::create($validated);

            $product->categories()->attach($request->input('category_id'));
            $product->categories()->attach($request->input('sub_category_id'));

            $product->industries()->sync((array) $request->input('industry_id'));
            $gallery = $request->file('gallery');
            if (!empty($gallery)) {
                foreach ($gallery as $file) {
                    $fileUpload = $this->uploadFile($file, $this->UPLOADFOLDER);
                    $photos[] = new ProductMedia([
                        'file' => $fileUpload,
                        'assigned_for' => 'gallery',
                    ]);
                }
                $product->media()->saveMany($photos);
            }
            if ($product) {
                $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function edit(Product $product)
    {
        if (view()->exists('backend.products.edit')) {
            $ids = $product->categories->pluck('id')->toArray();

            $compact = [
                'updateRoute' => route($this->ROUTE_PREFIX . '.update', $product->id),
                'row' => $product,
                'ids' => $ids,
                'media' => $product->media ?? '',
                'child_categories' => Category::select('id', 'title', 'parent_id')->whereIn('parent_id', $ids)->get(),
                'categories' => Category::whereNull('parent_id')->withCount('children')->get(),
                'industries' => Industry::select('id', 'title')->get(),
                'brands' => Brand::select('id', 'title')->get(),
                'destroyRoute' => route($this->ROUTE_PREFIX . '.destroy', $product->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans' => $this->TRANS,
            ];

            return view('backend.products.edit', $compact);
        }
    }

    /////////////
    public function update(ProductRequest $request, Product $product)
    {


        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $image = $product->image;
            if (!empty($request->file('image'))) {
                $product->image && File::exists(public_path($product->image)) ? $this->unlinkFile($product->image) : '';
                $image = $this->uploadFile($request->file('image'), $this->UPLOADFOLDER);
            }if (isset($request->drop_image_checkBox) && $request->drop_image_checkBox == 1) {
                $this->unlinkFile($product->image);
                $image = null;
            }
            $validated['image'] = $image;
            $product->categories()->sync([]);
            $product->categories()->attach($request->input('category_id'));
            $product->categories()->attach($request->input('sub_category_id'));
            $product->industries()->sync((array) $request->input('industry_id'));
            $product->update($validated);

            $gallery = $request->file('gallery');
            if (!empty($gallery)) {
                foreach ($gallery as $file) {
                    $fileUpload = $this->uploadFile($file, $this->UPLOADFOLDER);
                    $photos[] = new ProductMedia([
                        'file' => $fileUpload,
                        'assigned_for' => 'gallery',
                    ]);
                }
                $product->media()->saveMany($photos);
            }
            if (!empty($request->delete_gallery_id)) {
                $ids = $request->delete_gallery_id;
                $gallery = ProductMedia::whereIn('id', $ids);
                foreach ($gallery->get() as $selectedItems) {
                    $selectedItems->file ? $this->unlinkFile($selectedItems->file) : ''; // Unlink Images
                }
                $gallery->delete();
            }

            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);



    }
    public function destroy($id)
    {
        $product->image ? $this->unlinkFile($product->image) : '';
        if($product->media){
            $gallery = ProductMedia::where('product_id', $product->id);
            foreach ($gallery->get() as $selectedItems) {
                $selectedItems->file ? $this->unlinkFile($selectedItems->file) : ''; // Unlink Images
            }
            $gallery->delete();
        }

        if ($product->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $products = Product::whereIn('id', $ids); // Check
        foreach ($products->get() as $product) {
            $product->image ? $this->unlinkFile($product->image) : '';
        }
        if ($products->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function getSubCategories($category_id)
    {
        $query = Category::select('id', 'title', 'parent_id')->where('parent_id', $category_id)->get();
        $queryArr = [];
        foreach ($query as $value) {
            $queryArr[$value->id] = $value->title;
        }
        return response()->json($queryArr);
    }
}
