<?php
namespace App\Http\Controllers\backend;
use Carbon\Carbon;
use App\Models\SocialNetWork;
use App\Traits\Functions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SocialNetworkController extends Controller
{
    use Functions;
    public function __construct()
    {
        $this->ROUTE_PREFIX = 'admin.socialnetworks';
        $this->TRANS = 'social_media';
    }

    public function index(Request $request)
    {
        if (view()->exists('backend.social_links.index')) {
            $compact = [
                'trans' => $this->TRANS,
                'rows' => SocialNetWork::select('id', 'title', 'link')->get(),
                'createRoute' => route($this->ROUTE_PREFIX . '.create'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
            ];
            return view('backend.social_links.index', $compact);
        }
    }
    public function create()
    {
        if (view()->exists('backend.social_links.create')) {
            $compact = [
                'trans' => $this->TRANS,
                'listingRoute' => route($this->ROUTE_PREFIX . '.index'),
                'storeRoute' => route($this->ROUTE_PREFIX . '.store'),
            ];
            return view('backend.social_links.create', $compact);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->only('title', 'icon', 'link');

            $socialnetwork = SocialNetWork::create($validated);

            if ($socialnetwork) {
                $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageSuccess'), 'status' => true];
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'storeMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }

    public function edit(SocialNetWork $socialnetwork)
    {
        if (view()->exists('backend.social_links.edit')) {
            $compact = [
                'updateRoute' => route($this->ROUTE_PREFIX . '.update', $socialnetwork->id),
                'row' => $socialnetwork,
                'destroyRoute' => route($this->ROUTE_PREFIX . '.destroy', $socialnetwork->id),
                'redirect_after_destroy' => route($this->ROUTE_PREFIX . '.index'),
                'trans' => $this->TRANS,
            ];

            return view('backend.social_links.edit', $compact);
        }
    }

    /////////////
    public function update(Request $request, SocialNetWork $socialnetwork)
    {
        try {
            DB::beginTransaction();

            $validated = $request->only('title', 'icon', 'link');

            $socialnetwork->update($validated);

            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageSuccess'), 'status' => true];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $arr = ['msg' => __($this->TRANS . '.' . 'updateMessageError'), 'status' => false];
        }
        return response()->json($arr);
    }
    public function destroy(SocialNetWork $socialnetwork)
    {
        if ($socialnetwork->delete()) {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessagemsg')];
        } else {
            $arr = ['msg' => __($this->TRANS . '.' . 'deleteMessageError')];
        }
        return response()->json($arr);
    }
}
