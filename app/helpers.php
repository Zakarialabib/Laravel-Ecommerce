<?php

namespace App;

use Cache;
use Str; 
use Storage; 
use App\Models\Category;
use App\Models\Subcategory;

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

        $image = file_get_contents($image);
        $name = Str::random(10) . '.jpg';
        $path = public_path() . '/images/products/' . $name;
        file_put_contents($path, $image);
        return $name;
        
    }

      // get gallery from url and save to uploads/products
    public static function uploadGallery($gallery)
    {
        // Path cannot be empty
        if (empty($gallery)) {
            return null;
        }

       $gallery = explode(',', $gallery);
        $gallery = array_map(function ($image) {
            $image = file_get_contents($image);
            $name = Str::random(10) . '.jpg';
            $path = public_path() . '/images/products/' . $name;
            file_put_contents($path, $image);
            return $name;
        }, $gallery);
        return $gallery;

    }
     
    /**
     * Create Subcategory
     *
     * @return string
     */
    public static function createSubcategory($subcategory, $category)
    {
        return Subcategory::create([
            'name' => $subcategory,
            'slug' => Str::slug($subcategory, '-'),
            'categpry_id' => Category::where('name', $category)->first()->id,
            'language' => '3',
            ])->id;
    }

    
}