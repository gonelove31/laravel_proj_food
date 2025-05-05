<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        
        // Kiểm tra xem bảng settings có tồn tại không
        if (Schema::hasTable('settings')) {
            $keys = ['pusher_app_id', 'pusher_cluster', 'pusher_key', 'pusher_secret'];
            $pusherConf = Setting::whereIn('key', $keys)->pluck('value', 'key');

            config(['broadcasting.connections.pusher.key' => $pusherConf['pusher_key'] ?? null]);
            config(['broadcasting.connections.pusher.secret' => $pusherConf['pusher_secret'] ?? null]);
            config(['broadcasting.connections.pusher.app_id' => $pusherConf['pusher_app_id'] ?? null]);
            config(['broadcasting.connections.pusher.options.cluster' => $pusherConf['pusher_cluster'] ?? 'mt1']);
        }
    }
}
