<?php

declare(strict_types=1);

namespace App;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    /**
     * Fetch Cached settings from database
     *
     * @param mixed $key
     * @return mixed
     */
    public static function settings($key)
    {
        return Cache::rememberForever('settings', function () {
            return Settings::pluck('value', 'key');
        })->get($key);
    }

    public static function getActiveCategories()
    {
        return Category::active()
            ->select('id', 'name')
            ->get();
    }

    public static function categoryName($category_id)
    {
        return Category::find($category_id)->name;
    }

    public static function subcategoryName($subcategory_id)
    {
        return Subcategory::find($subcategory_id)->name;
    }

    public static function brandName($brand_id)
    {
        return Brand::find($brand_id)->name;
    }

    /**
     * @param mixed $product
     * @return string|null
     */
    public static function productLink($product)
    {
        if ($product) {
            return route('front.product', $product->slug);
        }

        return null;
    }

    /**
     * @param mixed $image
     * @return null|string
     */
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

    /**
     * @param mixed $gallery
     * @return null|string[]
     */
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
     * @param mixed $subcategory
     * @param mixed $category
     * @return mixed
     */
    public static function createSubcategory($subcategory, $category)
    {
        return Subcategory::create([
            'name'        => $subcategory,
            'slug'        => Str::slug($subcategory, '-'),
            'categpry_id' => Category::where('name', $category)->first()->id,
            'language'    => '3',
        ])->id;
    }

    /**
     * @param mixed $brand
     * @return mixed
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

    /**
     * @param mixed $value
     * @param bool $format
     * @return mixed
     */
    public static function format_currency($value, $format = true)
    {
        if ( ! $format) {
            return $value;
        }

        $currency = Currency::where('is_default', 1)->first();
        $position = $currency->position;
        $symbol = $currency->symbol;

        return 'prefix' === $position
            ? $symbol.number_format((float) $value, 2, '.', ',')
            : number_format((float) $value, 2, '.', ',').$symbol;
    }

    /**
     * @param mixed $input
     * @return string|false|void
     */
    public function handleUpload($input)
    {
        if (is_array($input)) {
            // handle gallery
            $galleryArray = [];

            foreach ($input as $key => $value) {
                $img = Image::make($value->getRealPath())->encode('webp', 85)->resize(1000, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->stream();
                Storage::disk('local_files')->put('products/'.$value->getClientOriginalName(), $img, 'public');
                $galleryArray[] = $value->getClientOriginalName();
            }

            return json_encode($galleryArray);
        } else {
            // handle single image

            $img = Image::make($input->getRealPath())->encode('webp', 85)->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->stream();

            Storage::disk('local_files')->put('products/'.$input->getClientOriginalName(), $img, 'public');
        }
    }
}
