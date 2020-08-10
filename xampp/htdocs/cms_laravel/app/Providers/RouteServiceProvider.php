<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Schema;//追加
use App\Theme;
use Illuminate\Support\Facades\DB; //追加

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapWebThemeRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }


    protected function mapWebThemeRoutes()
    {
        if (Schema::hasTable('themes')) {
            //テーブル存在
            $theme_first = DB::table('themes')->first();
            if(!empty($theme_first)){
                //入っているとき
                Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('public/themes/'.$theme_first->cms_name.'/webTheme.php'));
            }else{
                $theme = new \App\Theme;
                $theme->cms_name = 'DemoTheme';
                $theme->save();
            }
        }

        
        //dbに保存されているcms_nameに合わせてルーティング変更
        

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
