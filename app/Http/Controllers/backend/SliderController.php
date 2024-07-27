<?php
namespace App\Http\Controllers\backend;
use DataTables;
use Carbon\Carbon;
use App\Models\Slider;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\backend\SliderRequest;

class SliderController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.sliders';
        $this->TRANS = 'slider';
        $this->UPLOADFOLDER = 'sliders';
    }

    public function index(Request $request)
    {
        $model = Slider::select('id', 'title', 'image','link', 'created_at');
        if ($request->ajax()) {
            return Datatables::of($model)
                ->addIndexColumn()

                ->editColumn('image', function ($row) {
                    return $this->dataTableGetImage($row, $this->ROUTE_PREFIX . '.edit');
                })

                ->editColumn('title', function ($row) {
                    return '<a href=' . route($this->ROUTE_PREFIX . '.edit', $row->id) . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" . $row->id . "=\"item\">" . $row->title . '</a>';
                })

                ->editColumn('link', function ($row) {
                    return $row->link  ? '<a target=\"_blank\" href=' . $row->link . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\">" . $row->link . '</a>' : '-';
                })

                ->editColumn('created_at', function ($row) {
                    return $this->dataTableGetCreatedat($row->created_at);
                })

                ->editColumn('actions', function ($row) {
                    return $this->dataTableEditRecordAction($row, $this->ROUTE_PREFIX);
                })

                ->rawColumns(['image', 'title', 'link','actions', 'created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.sliders.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.sliders.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.sliders.create')) {
            $compact = [
                'trans' => $this->TRANS,
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.sliders.create', $compact);
        }
    }
    public function store(SliderRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $validated['image'] = !empty($validated['image']) ? $this->uploadFile($validated['image'], $this->UPLOADFOLDER) : null;

            $slider = Slider::create($validated);

            if ($slider) {
                $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function edit(Slider $slider)
    {
        if (view()->exists('backend.sliders.edit')) {
            $compact = [
                'updateRoute' => route($this->ROUTE_PREFIX . '.update', $slider->id),
                'row' => $slider,
                'destroyRoute' => route($this->ROUTE_PREFIX . '.destroy', $slider->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans' => $this->TRANS,
            ];

            return view('backend.sliders.edit', $compact);
        }
    }

    /////////////
    public function update(SliderRequest $request, Slider $slider)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $image = $slider->image;
            if (!empty($request->file('image'))) {
                $slider->image && File::exists(public_path($slider->image)) ? $this->unlinkFile($slider->image) : '';
                $image = $this->uploadFile($request->file('image'), $this->UPLOADFOLDER);
            }
            if (isset($request->drop_image_checkBox) && $request->drop_image_checkBox == 1) {
                $this->unlinkFile($slider->image);
                $image = null;
            }
            $validated['image'] = $image;
            $slider->update($validated);

            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(Slider $slider)
    {
        $slider->image ? $this->unlinkFile($slider->image) : '';
        if ($slider->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $sliders = Slider::whereIn('id', $ids); // Check
        foreach ($sliders->get() as $slider) {
            $slider->image ? $this->unlinkFile($slider->image) : '';
        }
        if ($sliders->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
}
