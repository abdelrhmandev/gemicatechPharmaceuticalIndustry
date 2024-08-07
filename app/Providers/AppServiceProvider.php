<?php

namespace App\Providers;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Industry;
use App\Models\SocialNetWork;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Administrator')) {
                return true;
            }
        });

        View::share('categories', Category::select('id', 'title', 'icon', 'slug')->whereNull('parent_id')->get()->take(4) ?? '');
        View::share('industries', Industry::select('id', 'slug', 'title')->get() ?? '');
        View::share('socialnetworks', SocialNetWork::select('id', 'icon', 'title', 'link')->get() ?? '');

        View::share('site_logo', Setting::where('key', 'site_logo')->first()->value ?? '');

        View::share('site_title', Setting::where('key', 'site_title')->first()->value ?? '');

        View::share('site_favicon', Setting::where('key', 'site_favicon')->first()->value ?? '');

        View::share('address', Setting::where('key', 'site_address')->first()->value ?? '');
        View::share('email', Setting::where('key', 'site_email')->first()->value ?? '');
        View::share('site_contact_us_page_email', Setting::where('key', 'site_contact_us_page_email')->first()->value ?? '');
        View::share('mobile', Setting::where('key', 'site_mobile')->first()->value ?? '');
        View::share('phone', Setting::where('key', 'site_phone')->first()->value ?? '');
    }
}
