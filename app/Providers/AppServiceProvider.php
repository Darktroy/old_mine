<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sponser;
use Auth;
use App\Models\Tag;
use App\Models\Post;

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
        $sponsers = Sponser::where('active',1)->get();
        View::share('sponsers',$sponsers);

        $tags = Tag::orderByRaw('RAND()')->take(15)->get();
        View::share('tags',$tags);

        $latestPostst = Post::orderBy('id','DESC')->take(2)->get();
        View::share('latestPostst',$latestPostst);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       if (env('PUBLIC_PATH') !== NULL) {
            //An example that demonstrates setting Laravel's public path.
            
            $this->app['path.public'] = env('PUBLIC_PATH');
            
            //An example that demonstrates setting a third-party config value.
            
            $this->app['config']->set('cartalyst.themes.paths', array(env('PUBLIC_PATH') . DIRECTORY_SEPARATOR . 'themes'));
        }
        
        //An example that demonstrates environment-detection.
        
        if ($this->app->environment() === 'local') {
            
        }
        elseif ($this->app->environment() === 'development') {
            
        }
        elseif ($this->app->environment() === 'test') {
            
        }
        elseif ($this->app->environment() === 'production') {
            
        }
    }
}
