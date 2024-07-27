<?php
namespace App\Http\Controllers\backend;
use Hash;
use DataTables;
use Carbon\Carbon;
use App\Models\Permission;
use App\Models\Admin;
use App\Traits\Functions;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\backend\AdminRequest;

class AdminController extends Controller
{
    use UploadAble, Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.admins';
        $this->TRANS = 'admin';
        $this->Tbl = 'admins';
        $this->UPLOADFOLDER = 'avatars';
    }
    public function store(AdminRequest $request)
    {
        $arry = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'avatar' => !empty($request->file('avatar')) ? $this->uploadFile($request->file('avatar'), $this->UPLOADFOLDER) : null,
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ];
        $admin = Admin::create($arry);
        if ($admin && $admin->assignRole($request->input('roles'))) {
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function create()
    {
        $compact = [
            'roles' => Role::select('id', 'name')->get(),
            'trans' => $this->TRANS,
            'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
        ];
        return view('backend.admins.create', $compact);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Admin::select('id', 'name', 'mobile', 'email', 'avatar', 'is_active', 'created_at')
                ->with([
                    'roles' => function ($query) {
                        $query->select('id', 'name'); # Many to many
                    },
                ])
                ->withCount(['roles']);
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    $avatar = !empty($row->avatar) ? asset($row->avatar) : asset('assets/backend/media/avatars/blank.png');
                    return "<div class=\"d-flex align-items-center\">
                    <div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">
                        <a href=\"#\">
                            <div class=\"symbol-label\">
                                <img src=" .
                        $avatar .
                        ' alt=' .
                        $row->name .
                        " class=\"w-100\" />
                            </div>
                        </a>
                    </div>
                    <div class=\"d-flex flex-column\">
                        <a href=" .
                        '#' .
                        " class=\"text-gray-800 text-hover-primary mb-1\">" .
                        $row->name .
                        "</a>
                        <span><a href=\"mailto:" .
                        $row->email .
                        "\">" .
                        $row->email .
                        "</a></span>
                    </div>
                </div>";
                })
                ->AddColumn('role', function (Admin $row) {
                    $roleDiv = '';
                    if ($row->roles_count > 0) {
                        foreach ($row->roles as $role) {
                            $roleDiv .= "<div class=\"badge py-3 px-4 fs-7 badge-light-primary\"><span class=\"text-primary\">" . $role->name . '</span></div> ';
                        }
                    } else {
                        $roleDiv = "<span class=\"text-danger\">" . __('user.no_roles_assigned') . '</span>';
                    }
                    return $roleDiv;
                })
                ->editColumn('is_active', function (Admin $row) {
                    if ($row->is_active == 1) {
                        $checked = 'checked';
                        $statusLabel = "<span class=\"text-success\">" . __('site.active') . '</span>';
                    } else {
                        $checked = '';
                        $statusLabel = "<span class=\"text-danger\">" . __('site.deactivated') . '</span>';
                    }
                    $div = "<div class=\"form-check form-switch form-check-custom form-check-solid\"><input class=\"form-check-input UpdateStatus\" name=\"Updatetatus\" type=\"checkbox\" " . $checked . " id=\"Status" . $row->id . "\" onclick=\"UpdateStatus($row->id,'" . __($this->TRANS . '.plural') . "','$this->Tbl','" . route('admin.UpdateStatus') . "')\" />&nbsp;" . $statusLabel . '</div>';
                    return $div;
                })
                ->editColumn('created_at', function (Admin $row) {
                    return $this->dataTableGetCreatedat($row->created_at);
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
                })
                ->editColumn('actions', function ($row) {
                    return $this->dataTableEditRecordAction($row, $this->ROUTE_PREFIX);
                })
                ->rawColumns(['name', 'role', 'is_active', 'actions', 'created_at', 'created_at.display'])
                ->make(true);
        }
        if (view()->exists('backend.admins.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'destroyMultipleRoute' => route($this->ROUTE_PREFIX . '.destroyMultiple'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'allrecords' => Admin::count(),
            ];
            return view('backend.admins.index', $compact);
        }
    }
    public function edit(Admin $admin)
    {
        if (view()->exists('backend.admins.edit')) {
            $compact = [
                'updateRoute'            => route($this->ROUTE_PREFIX . '.update', $admin->id),
                'row'                    => $admin,
                'destroyRoute'           => route($this->ROUTE_PREFIX . '.destroy', $admin->id),
                'trans'                  => $this->TRANS,
                'roles'                  => Role::pluck('name','name')->all(),
                'adminRole'              => $admin->roles->pluck('name','name')->all(),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'editPasswordRoute'      => route($this->ROUTE_PREFIX.'.editpassword',$admin->id),
                'updatePasswordRoute'    => route($this->ROUTE_PREFIX.'.updatepassword',$admin->id),
            ];
            return view('backend.admins.edit', $compact);
        }
    }

    public function update(AdminRequest $request, Admin $admin)
    {




        $avatar = $admin->avatar;
        if(!empty($request->file('avatar'))) {
            $avatar && File::exists(public_path($avatar)) ? $this->unlinkFile($avatar): '';
            $avatar =  $this->uploadFile($request->file('avatar'),$this->UPLOADFOLDER);
         }
        $arry = [
            'name'          => $request->input('name'),
            'username'      => $request->input('username'),
            'email'         => $request->input('email'),
            'mobile'        => $request->input('mobile'),
            'avatar'        => $avatar,
            'is_active'     => isset($request->is_active) ? '1' : '0',

        ];
        if(Admin::findOrFail($admin->id)->update($arry)){
            $arr = ['msg' => __($this->TRANS . '.updateMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(Admin $admin)
    {
        if ($admin->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        $items = Admin::whereIn('id', $ids); // Check
        if ($items->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'MulideleteMessageSuccess'), 'status' => true];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'MiltideleteMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
}
