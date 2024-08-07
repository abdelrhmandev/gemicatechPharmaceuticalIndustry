<?php
namespace App\Http\Controllers\backend;
use DataTables;
use Carbon\Carbon;
use App\Models\Industry;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\backend\IndustryRequest;

class IndustryController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.industries';
        $this->TRANS = 'industry';
        $this->UPLOADFOLDER = 'industries';
        $this->middleware('permission:'.$this->TRANS.'-list,admin');
        $this->middleware('permission:'.$this->TRANS.'-create,admin', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->TRANS.'-edit,admin', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->TRANS.'-delete,admin', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $model = Industry::select('id', 'title','image', 'color', 'icon', 'created_at')->WithCount('product');
        if ($request->ajax()) {
            return Datatables::of($model)
                ->addIndexColumn()

                ->editColumn('image', function ($row) {
                    return $this->dataTableGetImage($row, $this->ROUTE_PREFIX . '.edit');
                })

                ->editColumn('title', function ($row) {
                    return '<a href=' . route($this->ROUTE_PREFIX . '.edit', $row->id) . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" . $row->id . "=\"item\">" . $row->title . '</a>';
                })

                ->editColumn('color', function ($row) {
                    return '<h1 style="color:'.$row->color.';">.</h1>';
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

                ->rawColumns(['image', 'title','color','product_count', 'actions', 'created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.industries.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.industries.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.industries.create')) {
            $compact = [
                'trans' => $this->TRANS,
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.industries.create', $compact);
        }
    }
    public function store(IndustryRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $validated['title'] = $validated['title'];
            $validated['slug']  = Str::slug($validated['title']);
            $validated['image'] = !empty($validated['image']) ? $this->uploadFile($validated['image'], $this->UPLOADFOLDER) : null;

            $industry = Industry::create($validated);

            if ($industry) {
                $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function edit(Industry $industry)
    {
        if (view()->exists('backend.industries.edit')) {
            $compact = [
                'updateRoute' => route($this->ROUTE_PREFIX . '.update', $industry->id),
                'row' => $industry,
                'destroyRoute' => route($this->ROUTE_PREFIX . '.destroy', $industry->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans' => $this->TRANS,
            ];

            return view('backend.industries.edit', $compact);
        }
    }

    /////////////
    public function update(IndustryRequest $request, Industry $industry)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $image = $industry->image;
            if (!empty($request->file('image'))) {
                $industry->image && File::exists(public_path($industry->image)) ? $this->unlinkFile($industry->image) : '';
                $image = $this->uploadFile($request->file('image'), $this->UPLOADFOLDER);
            }
            if (isset($request->drop_image_checkBox) && $request->drop_image_checkBox == 1) {
                $this->unlinkFile($industry->image);
                $image = null;
            }
            $validated['image'] = $image;
            $industry->update($validated);

            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(Industry $industry)
    {
        $industry->image ? $this->unlinkFile($industry->image) : '';
        if ($industry->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $industries = Industry::whereIn('id', $ids); // Check
        foreach ($industries->get() as $industry) {
            $industry->image ? $this->unlinkFile($industry->image) : '';
        }
        if ($industries->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
}
