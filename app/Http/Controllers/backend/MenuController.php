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

class MenuController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX  = 'admin.products';
        $this->TRANS         = 'product';
        $this->UPLOADFOLDER  = 'products';
    }

    public function index(Request $request)
    {

        $model = Product::select('id','title','brand_id','created_at');

        if ($request->ajax()) {
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('title', function ($row) {
                     return '<a href=' .
                        route($this->ROUTE_PREFIX . '.edit', $row->id) .
                        " class=\"text-gray-800 text-hover-primary fs-5 fw-bold mb-1\" data-kt-item-filter" .
                        $row->id .
                        "=\"item\">" .
                        $row->title .
                        '</a>';

                })

                ->editColumn('brand', function ($row) {
                    return   $row->brand_id;

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

                ->rawColumns(['image', 'title','actions', 'created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.products.index')) {
            $compact = [
                'trans'                 => $this->TRANS,
                'createRoute'           => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute'            => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute'  => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute'          => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.products.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.products.create')) {
            $compact = [
                'categories'    => Category::whereNull('parent_id')->withCount('children')->get(),
                'industries'    => Industry::select('id', 'title')->get(),
                'brands'        => Brand::select('id', 'title')->get(),
                'trans'         => $this->TRANS,
                'listingRoute'  => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute'    => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.products.create', $compact);
        }
    }
    public function store(ProductRequest $request)
    {

        try {
            DB::beginTransaction();

        $validated = $request->validated();
        $validated['title']  = $validated['title'].time();
        $validated['slug']   = Str::slug($validated['title']);
        $validated['image']  = !empty($validated['image']) ? $this->uploadFile($validated['image'], $this->UPLOADFOLDER) : null;

        $product = Product::create($validated);


        $product->categories()->attach($request->input('category_id'));
        $product->categories()->attach($request->input('sub_category_id'));


        $product->industries()->sync((array) $request->input('industry_id'));
        $gallery = $request->file('gallery');
        if (!empty($gallery)) {
            foreach ($gallery as $file) {
                $fileUpload = $this->uploadFile($file, $this->UPLOADFOLDER);
                    $photos[] = new ProductMedia([
                        'file'         => $fileUpload,
                        'assigned_for' => 'gallery',
                    ]);
             }
             $product->gallery()->saveMany($photos);
        }



        if ($product) {
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
        }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $arr = array('msg' => __($this->TRANS.'.'.'storeMessageError'), 'status' => false);
        }
        return response()->json($arr);
    }



    public function edit(Game $game)
    {
        if (view()->exists('backend.products.edit')) {
            $compact = [
                'updateRoute'            => route($this->ROUTE_PREFIX . '.update', $game->id),
                'row'                    => $game,
                'types'                  => Type::select('id', 'title')->get(),
                'groups'                 => Group::select('id', 'title')->where('brand_id',$game->brand_id)->withCount('questions')->get(),
                'destroyRoute'           => route($this->ROUTE_PREFIX . '.destroy', $game->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans'                  => $this->TRANS,
            ];
            return view('backend.products.edit', $compact);
        }
    }

    /////////////
public function update(ProductRequest $request, Game $game)
    {


        $validated = $request->validated();
        $EventDateRange = explode(' - ', $request->event_date_range);

        //////////
        $image = $game->image;
        if (!empty($request->file('image'))) {
            $game->image && File::exists(public_path($game->image)) ? $this->unlinkFile($game->image) : '';
            $image = $this->uploadFile($request->file('image'), $this->UPLOADFOLDER);
        }
        if (isset($request->drop_image_checkBox) && $request->drop_image_checkBox == 1) {
            $this->unlinkFile($game->image);
            $image = null;
        }


        ////////////

        $GameArr = [
            'title'             => $validated['title'],
            'slug'              => Str::slug($validated['title']),
            'image'             => $image,
            'description'       => $validated['description'],
            'color'             => $validated['color'] ?? null,
            'attendees'         => $validated['attendees'],
            'type_id'           => $validated['type_id'],
            'brand_id'          => $validated['brand_id'],
            'group_id'          => $validated['group_id'],
            'play_with_team'    => $validated['play_with_team'] ?? '0',
            'team_players'      => $validated['team_players'] ?? null,
            'event_title'       => $validated['event_title'],
            'event_start_date'  => $EventDateRange[0],
            'event_end_date'    => $EventDateRange[1],
            'event_location'    => $validated['event_location'],
        ];

        GameQuestion::where(['game_id'=>$game->id,'brand_id'=>$game->brand_id,'group_id'=>$game->group_id])->delete();

        $GroupQuestions = GroupQuestion::where('group_id',$request->group_id)->get();
        $arr = [];
        foreach($GroupQuestions as $key=>$value){
            $arr[$key] = [
                'game_id'       =>$game->id,
                'group_id'      =>$request->group_id,
                'question_id'   =>$value->question_id,
                'order'         =>$value->order,
                'brand_id'      =>$request->brand_id
            ];
        }
        GameQuestion::insert($arr);

        if (Product::findOrFail($game->id)->update($GameArr)) {
            $arr = ['msg' => __($this->TRANS . '.updateMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(Game $game)
    {
        //SET ALL childs to NULL
        if ($game->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $items = Product::whereIn('id', $ids); // Check
        if ($items->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function getSubCategories($category_id)
    {
        $query = Category::select('id','title', 'parent_id')
            ->where('parent_id', $category_id)
            ->get();
        $queryArr = [];
        foreach ($query as $value) {
            $queryArr[$value->id] = $value->title;
        }
        return response()->json($queryArr);
    }


}
