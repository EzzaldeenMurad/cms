<?php

namespace App\Providers;

use App\Http\Composers\CategoryComposer;
use App\Http\Composers\CommentComposer;
use App\Http\Composers\PageComposer;
use App\Http\Composers\RoleComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['partials.sidebar', 'lists.categories'], CategoryComposer::class);
        View::composer('partials.sidebar', CommentComposer::class);
        View::composer('lists.roles', RoleComposer::class);
        view::composer('partials.navbar', PageComposer::class);

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
