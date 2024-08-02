<?php

namespace App\Providers;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Industry;
use App\Models\SocialNetWork;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('categories', Category::select('id', 'title', 'icon', 'slug')->whereNull('parent_id')->get()->take(4));
        View::share('industries', Industry::select('id', 'slug', 'title')->get());
        View::share('socialnetworks', SocialNetWork::select('id', 'icon', 'title', 'link')->get());

        View::share('address', Setting::where('key', 'site_address')->first());
        View::share('email', Setting::where('key', 'site_email')->first());
        View::share('mobile', Setting::where('key', 'site_mobile')->first());
        View::share('phone', Setting::where('key', 'site_phone')->first());
    }
}
