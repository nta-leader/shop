<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Model\Shop\Cat;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $cat=new Cat();
        $objItems=$cat->getList();
        view::share('objCats',$objItems);
        view::share('urlShop',getenv('SHOP'));
        view::share('urlAdmin',getenv('ADMIN'));
        view::share('urlWeb',getenv('URLWEB'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
