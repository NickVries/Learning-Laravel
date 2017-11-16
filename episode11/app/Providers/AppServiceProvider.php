<?php

namespace App\Providers;

use App\Post;
use App\Tag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.debug') === true) {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        }

        view()->composer('layouts.sidebar', function ($view) {
            $archives = Post::archives();
            $tags = Tag::has('posts')->pluck('name');

            $view->with(compact('archives', 'tags'));
        });
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
