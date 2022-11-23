<?php

namespace App;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\Subcategory;
use Cache;
use Str;

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
            return Settings::pluck('value', 'key');
        })->get($key);
    }

    public static function productLink($product)
    {
        if ($product) {
            return route('front.product', $product->slug);
        }

        return null;
    }

    // get upload image to db from link
    public static function uploadImage($image)
    {
        // Path cannot be empty
        if (empty($image)) {
            return null;
        }

        $image = file_get_contents($image);
        $name = Str::random(10).'.jpg';
        $path = public_path().'/images/products/'.$name;
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
            $name = Str::random(10).'.jpg';
            $path = public_path().'/images/products/'.$name;
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

    public static function format_currency($value, $format = true)
    {
        if (! $format) {
            return $value;
        }

        $currency = Currency::where('is_default', 1)->first();
        $position = $currency->position;
        $symbol = $currency->symbol;

        return 'prefix' === $position
            ? $symbol.number_format((float) $value, 2, '.', ',')
            : number_format((float) $value, 2, '.', ',').$symbol;
    }
}
