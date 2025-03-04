<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cek apakah aplikasi berada di lingkungan lokal (local)
        if (config('app.env') == 'local') {
            // Menonaktifkan pengalihan otomatis ke HTTPS dalam lingkungan lokal
            URL::forceScheme('http');
        } else {
            // Jika di environment selain local, tetap memaksa HTTPS
            URL::forceScheme('https');
        }
    }
}
