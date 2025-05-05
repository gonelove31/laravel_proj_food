<?php

namespace App\Providers;

use App\Services\PaymentGatewaySettingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class PaymentGatewaySettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewaySettingService::class, function(){
            return new PaymentGatewaySettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Kiểm tra xem bảng payment_gateway_settings có tồn tại không
        if (Schema::hasTable('payment_gateway_settings')) {
            $paymentGatewaySetting = $this->app->make(PaymentGatewaySettingService::class);
            $paymentGatewaySetting->setGlobalSettings();
        }
    }
}
