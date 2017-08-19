<?php

namespace App\Providers;

use App\post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        post::creating(function($post){
           $post->slug=str_slug($post->title);

            if (!Auth::guest()) {
                $post->user_id = Auth::user()->id;
            }
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
