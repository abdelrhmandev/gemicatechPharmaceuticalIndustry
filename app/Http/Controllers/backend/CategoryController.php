<?php
namespace App\Http\Controllers\backend;
use DataTables;
use Carbon\Carbon;
use App\Models\Category;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\backend\CategoryRequest;

class CategoryController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.categories';
        $this->TRANS = 'category';
        $this->UPLOADFOLDER = 'categories';
    }

    public function index(Request $request)
    {
        $model = Category::select('id', 'title', 'parent_id', 'color', 'icon', 'created_at')
            ->with(['parent'])
            ->WithCount('product');
        if ($request->ajax()) {
            return Datatables::of($model)
                ->addIndexColumn()

                ->editColumn('image', function ($row) {
                    return $this->dataTableGetImage($row, $this->ROUTE_PREFIX . '.edit');
                })

                ->editColumn('title', function ($row) {
                    return '<a href=' . route($this->ROUTE_PREFIX . '.edit', $row->id) . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" . $row->id . "=\"item\">" . $row->title . '</a>';
                })

                ->editColumn('parent_id', function ($row) {
                    $parent = $row->parent ? '<a href=' . route($this->ROUTE_PREFIX . '.edit', $row->id) . " class=\"text-primary opacity-75-hover fs-6 fw-semibold\" data-kt-item-filter" . $row->id . "=\"item\">" . $row->parent->title ?? '' . '</a>' : '<span aria-hidden="true">—</span>';

                    return $parent;
                })

                ->addColumn('product_count', function ($row) {
                    return  "<a href=".'#'.">
                                <span class=\"badge badge-circle badge-primary\">".$row->product_count ?? '0' ."</span>
                                </a>";
                })
                ->editColumn('created_at', function ($row) {
                    return $this->dataTableGetCreatedat($row->created_at);
                })

                ->editColumn('actions', function ($row) {
                    return $this->dataTableEditRecordAction($row, $this->ROUTE_PREFIX);
                })

                ->rawColumns(['image', 'title', 'parent_id','product_count', 'actions', 'created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.categories.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.categories.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.categories.create')) {
            $compact = [
                'parent_categories' => Category::whereNull('parent_id')->get(),
                'trans' => $this->TRANS,
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.categories.create', $compact);
        }
    }
    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $validated['slug']  = Str::slug($validated['title']);
            $validated['image'] = !empty($validated['image']) ? $this->uploadFile($validated['image'], $this->UPLOADFOLDER) : null;

            $category = Category::create($validated);

            if ($category) {
                $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function edit(Category $category)
    {
        if (view()->exists('backend.categories.edit')) {
            $compact = [
                'updateRoute' => route($this->ROUTE_PREFIX . '.update', $category->id),
                'row' => $category,
                'parent_categories' => Category::whereNull('parent_id')->withCount('children')->get(),
                'destroyRoute' => route($this->ROUTE_PREFIX . '.destroy', $category->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans' => $this->TRANS,
            ];

            return view('backend.categories.edit', $compact);
        }
    }

    /////////////
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $image = $category->image;
            if (!empty($request->file('image'))) {
                $category->image && File::exists(public_path($category->image)) ? $this->unlinkFile($category->image) : '';
                $image = $this->uploadFile($request->file('image'), $this->UPLOADFOLDER);
            }
            if (isset($request->drop_image_checkBox) && $request->drop_image_checkBox == 1) {
                $this->unlinkFile($category->image);
                $image = null;
            }
            $validated['image'] = $image;
            $category->update($validated);

            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(Category $category)
    {
        $category->image ? $this->unlinkFile($category->image) : '';
        if ($category->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $categories = Category::whereIn('id', $ids); // Check
        foreach ($categories->get() as $category) {
            $category->image ? $this->unlinkFile($category->image) : '';
        }
        if ($categories->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
}
