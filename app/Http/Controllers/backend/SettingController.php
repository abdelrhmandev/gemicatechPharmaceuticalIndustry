<?php
namespace App\Http\Controllers\backend;
use DataTables;
use Carbon\Carbon;
use App\Models\Setting;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.settings';
        $this->TRANS = 'setting';
    }
    public function index()
    {
        $compact = [
            'trans' => $this->TRANS,
            'createRoute' => route($this->ROUTE_PREFIX . '.create'),
            'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
            'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            'settings' => Setting::all(),
        ];
        return view('backend.settings.index', $compact);
    }

    public function store(Request $request)
    {
        $data = [];
        foreach ($request->field_id as $k => $v) {
            $fieldId = intval($k);
            $F_type = substr($k, strpos($k, '-') + 1);
            if ($F_type == 'image' || $F_type == 'file') {
                if (!empty($v)) {
                    $fileNameToStore = Str::random(25) . '.' . $v->getClientOriginalExtension();
                    $v->move(public_path('uploads/'), $fileNameToStore);
                    $v = 'uploads/' . $fileNameToStore;
                }
            } else {
                // $data[$fieldId] = $v;
            }
            \DB::table('settings')
                ->where('id', $k)
                ->update(['value' => $v]);
        }

        $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
        return response()->json($arr);
    }
}
