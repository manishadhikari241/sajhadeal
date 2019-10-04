<?php

namespace App\Providers;

use App\Ad;
use App\Brand;
use App\category;
use App\Product;
use App\Setup;
use App\Size;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        dd('ok');
        Schema::defaultStringLength(191);
        //        $cart_content=Cart::session(Sentinel::getUser()->id)->getContent();
        $setting=Setup::all()->last();
        View::share(compact('setting'));
        $last_item = Product::all()->last();
        View::share('item', $last_item);
        $items = Product::orderBy('id', 'desc')->take(5)->get();
        View::share('products', $items);
        $categories = Category::where('parent_id', 0)->get();
        View::share(compact('categories'));
        $child_categories = Category::all();
        View::share(compact('child_categories'));
        $ads=Ad::all();
        View::share(compact('ads'));
        $brands=Brand::all();
        View::share(compact('brands'));
        $sizes=Size::all();
        View::share(compact('sizes'));
    }
}

