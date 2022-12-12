<?php

namespace App;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\Subcategory;
use App\Models\Brand;
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
    /**
     * Create Brand
     *
     * @return string
     */
    public static function createBrand($brand)
    {
           // Make sure $brand is a string
        $brand = implode('', $brand);

        return Brand::create([
            'name' => $brand,
            'slug' => Str::slug($brand, '-'),
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

    public function handleUpload($input) {
        if(is_array($input)) {
            // handle gallery
            $galleryArray = [];
            foreach ($input as $key => $value) {
                $img = ImageIntervention::make($value->getRealPath())->encode('jpg', 75)->resize(1500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
    
                $img->stream();
                Storage::disk('local_files')->put('products/'.$value->getClientOriginalName(), $img, 'public');
                $galleryArray[] = $value->getClientOriginalName();
            }
    
            $this->product->gallery = json_encode($galleryArray);
        } else {
            // handle single image

            $img = ImageIntervention::make($input->getRealPath())->encode('jpg', 75)->resize(1500, 1500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->stream();

            Storage::disk('local_files')->put('products/'.$input->getClientOriginalName(), $img, 'public');

            $this->product->image = $imageName;
        }
    
    }
}
