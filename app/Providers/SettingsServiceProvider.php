<?php

namespace App\Providers;

use App\Services\SettingsService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function(){
            return new SettingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Kiểm tra xem bảng settings có tồn tại không
        if (Schema::hasTable('settings')) {
            $settingsService = $this->app->make(SettingsService::class);
            $settingsService->setGlobalSettings();
        }
    }
}
