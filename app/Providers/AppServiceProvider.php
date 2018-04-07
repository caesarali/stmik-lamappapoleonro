<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Jurusan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        $jurusans = [];
        $jurusan = Schema::hasTable('jurusan');
        if ($jurusan) {
            $jurusans = Jurusan::orderBy('name', 'ASC')->get();
        }

        View::share('mhsMenu', $jurusans);
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
