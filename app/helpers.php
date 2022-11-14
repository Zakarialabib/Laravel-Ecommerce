<?php

namespace App;

use Cache;
use Str; 
use Storage; 

class Helpers
{
    /**
     * Fetch Cached settings from database
     *
     * @return string
     */
    public static function settings($key)
    {
        return Cache::rememberForever('settings', function () {
            return \App\Models\Settings::pluck('value', 'key');
        })->get($key);
        // return Cache::get('settings')->where('key', $key)->first()->value;
    }

    // get product link 
    public static function productLink($product)
    {
        return route('front.product', [$product->slug]);
    }
    // usage 
    // <a href="{{ Helpers::productLink($product) }}" class="text-gray-700 hover:text-gray-800">
    
    // get upload image to db from link
    public static function uploadImage($image)
    {
        // Path cannot be empty
        if (empty($image)) {
            return null;
        }
        //  get the file and name it with str random(5) and save

        $image = file_get_contents($image);
        $name = Str::random(10) . '.jpg';
        $path = public_path() . '/images/products/' . $name;
        file_put_contents($path, $image);
        return $name;
        
    }

    
}