<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Category;
use App\Newspaper;
use App\Author;

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
      Schema::defaultStringLength(191);
      $categories =  Category::all();
      $hotNews = Newspaper::getHotNews(6);
      $authors = Author::all();

      View::share(['categories' => $categories, 'hotNews' => $hotNews, 'authors' => $authors]);
    }
}
