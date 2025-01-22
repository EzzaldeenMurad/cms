<?php

namespace App\Providers;

use App\Http\Composers\CategoryComposer;
use App\Http\Composers\CommentComposer;
use App\Http\Composers\PageComposer;
use App\Http\Composers\RoleComposer;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        // $this->bindRepositories();
    }


    // Bind all repository interfaces to their respective classes
    protected function bindRepositories()
    {
        foreach (glob(app_path('Repositories/Contracts') . '/*RepositoryInterface.php') as $interface) {
            $interfaceName = basename($interface, '.php');
            $repositoryName =  Str::replace('Interface', '', $interfaceName);
            $repositoryClass = 'App\\Repositories\\' . $repositoryName;
            if (class_exists($repositoryClass)) {
                $this->app->bind(
                    "App\\Repositories\\Contracts\\$interfaceName",
                    $repositoryClass
                );
            }
        }
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
