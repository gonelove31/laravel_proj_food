<?php

namespace App\Services;

use App\Models\PaymentGatewaySetting;
use Cache;
use Illuminate\Support\Facades\Schema;

class PaymentGatewaySettingService {

    function getSettings() {
        return Cache::rememberForever('gatewaySettings', function(){
            try {
                if (Schema::hasTable('payment_gateway_settings')) {
                    return PaymentGatewaySetting::pluck('value', 'key')->toArray(); // ['key' => 'value']
                }
                return [];
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    function setGlobalSettings() : void {
        $settings = $this->getSettings();
        config()->set('gatewaySettings', $settings);
    }

    function clearCachedSettings() : void {
        Cache::forget('gatewaySettings');
    }

}
