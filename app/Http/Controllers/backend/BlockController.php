<?php
namespace App\Http\Controllers\backend;
use DataTables;
use Carbon\Carbon;
use App\Models\Block;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\backend\BlockRequest;

class BlockController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.blocks';
        $this->TRANS = 'block';
        $this->UPLOADFOLDER = 'blocks';
    }

    public function index(Request $request)
    {
        $model = Block::select('id', 'title', 'image', 'created_at');
        if ($request->ajax()) {
            return Datatables::of($model)
                ->addIndexColumn()

                ->editColumn('image', function ($row) {
                    return $this->dataTableGetImage($row, $this->ROUTE_PREFIX . '.edit');
                })

                ->editColumn('title', function ($row) {
                    return '<a href=' . route($this->ROUTE_PREFIX . '.edit', $row->id) . " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" . $row->id . "=\"item\">" . $row->title . '</a>';
                })


                ->editColumn('created_at', function ($row) {
                    return $this->dataTableGetCreatedat($row->created_at);
                })

                ->editColumn('actions', function ($row) {
                    return $this->dataTableEditRecordAction($row, $this->ROUTE_PREFIX);
                })

                ->rawColumns(['image','title','actions','created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.blocks.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.blocks.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.blocks.create')) {
            $compact = [
                'trans' => $this->TRANS,
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.blocks.create', $compact);
        }
    }
    public function store(BlockRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            $validated['image'] = !empty($validated['image']) ? $this->uploadFile($validated['image'], $this->UPLOADFOLDER) : null;

            $block = Block::create($validated);

            if ($block) {
                $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function edit(Block $block)
    {
        if (view()->exists('backend.blocks.edit')) {
            $compact = [
                'updateRoute' => route($this->ROUTE_PREFIX . '.update', $block->id),
                'row' => $block,
                'destroyRoute' => route($this->ROUTE_PREFIX . '.destroy', $block->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans' => $this->TRANS,
            ];

            return view('backend.blocks.edit', $compact);
        }
    }

    /////////////
    public function update(BlockRequest $request, Block $block)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $image = $block->image;
            if (!empty($request->file('image'))) {
                $block->image && File::exists(public_path($block->image)) ? $this->unlinkFile($block->image) : '';
                $image = $this->uploadFile($request->file('image'), $this->UPLOADFOLDER);
            }
            if (isset($request->drop_image_checkBox) && $request->drop_image_checkBox == 1) {
                $this->unlinkFile($block->image);
                $image = null;
            }
            $validated['image'] = $image;
            $block->update($validated);

            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(Block $block)
    {
        $block->image ? $this->unlinkFile($block->image) : '';
        if ($block->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $blocks = Block::whereIn('id', $ids); // Check
        foreach ($blocks->get() as $block) {
            $block->image ? $this->unlinkFile($block->image) : '';
        }
        if ($blocks->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
}
