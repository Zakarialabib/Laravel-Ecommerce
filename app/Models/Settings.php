<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];

    public static function get($key)
    {
        $setting = self::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }
        return null;
    }
    // exmaple usage:
    // $settings = Settings::get('key');
    // $settings = Settings::get('key', 'default value');
    // $site_name = Settings::get('site_name');


    public static function set($key, $value)
    {
        $setting = self::where('key', $key)->first();
        if ($setting) {
            $setting->value = $value;
            $setting->save();
        } else {
            $setting = self::create([
                'key' => $key,
                'value' => $value,
            ]);
        }
        return $setting;
    }
    // exmaple usage:
    // Settings::set('site_name', 'My Site');

    
}
