<?php

namespace App\Services;

use App\Models\Setting;
use Cache;
use Illuminate\Support\Facades\Schema;

class SettingsService {

    function getSettings() {
        return Cache::rememberForever('settings', function(){
            try {
                if (Schema::hasTable('settings')) {
                    return Setting::pluck('value', 'key')->toArray(); // ['key' => 'value']
                }
                return [];
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    function setGlobalSettings() : void {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    function clearCachedSettings() : void {
        Cache::forget('settings');
    }

}
