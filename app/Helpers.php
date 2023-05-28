<?php

declare(strict_types=1);

namespace App;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Helpers
{
    /**
     * Fetch Cached settings from database
     *
     * @param mixed $key
     *
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

    public static function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }

    public static function formatDate($timestamp)
    {
        return date('F j, Y, g:i a', $timestamp);
    }


    public static function getActiveBrands()
    {
        return Brand::active()
            ->select('id', 'name', 'slug')
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
     *
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
     * Uploads an image from a URL and returns the file name.
     *
     * @param string $image_url The URL of the image to upload.
     * @param string $productName The name of the product.
     * @param int $size The size of the square to resize the image to.
     *
     * @return string|null The name of the uploaded file, or null if the upload failed.
     */
    public static function uploadImage($image_url, $productName)
    {
        $opts = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];
    
        $context = stream_context_create($opts);
    
        $image = file_get_contents($image_url, false, $context);
        $name = Str::slug($productName).'-'.sprintf('%02d', 0).'.jpg';
        $path = public_path().'/images/products/'.$name;
        file_put_contents($path, $image);

        return $name;
    }


    /**
     * @param mixed $gallery
     *
     * @return array<string>|null
     */
    public static function uploadGallery($gallery)
    {
        // Path cannot be empty
        if (empty($gallery)) {
            return null;
        }

        $gallery = explode(',', $gallery);

        return array_map(function ($image) {
            $image = file_get_contents($image);
            $name = Str::random(10).'.jpg';
            $path = public_path().'/images/products/'.$name;
            file_put_contents($path, $image);

            return $name;
        }, $gallery);
    }

    /**
     * @param mixed $category
     *
     * @return mixed
     */
    public static function createCategory($category)
    {
        // Make sure $category is a string
        $category = implode('', $category);

        return Category::create([
            'name' => $category,
            'slug' => Str::slug($category, '-'),
        ])->id;
    }

    /**
     * @param mixed $subcategory
     * @param mixed $category
     *
     * @return mixed
     */
    public static function createSubcategories($subcategories, $category)
    {
        $subcategoryIds = [];

        foreach (explode(',', $subcategories) as $subcategory) {
            $subcategoryModel = Subcategory::create([
                'name'        => trim($subcategory),
                'slug'        => Str::slug($subcategory, '-'),
                'category_id' => Category::where('name', $category)->first()->id,
                'language'    => '3',
            ]);
            $subcategoryIds[] = $subcategoryModel->id;
        }

        return $subcategoryIds;
    }

    /**
     * @param mixed $brand
     *
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
     *
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

        return $position === 'prefix'
            ? $symbol.number_format((float) $value, 2, '.', ',')
            : number_format((float) $value, 2, '.', ',').$symbol;
    }

    public static function handleUpload($image, $width, $height, $productName)
    {
        $imageName = Str::slug($productName).'-'.Str::random(5).'.'.$image->extension();

        $img = Image::make($image->getRealPath())->encode('webp', 85);

        // we need to resize image, otherwise it will be cropped
        if ($img->width() > $width) {
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if ($img->height() > $height) {
            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $watermark = Image::make(public_path('images/logo/logo.png'));
        $watermark->opacity(25);
        $watermarkWidth = intval($width / 5);
        $watermarkHeight = intval($watermarkWidth * $watermark->height() / $watermark->width());
        $img->insert($watermark, 'bottom-left', 20, 20)->resizeCanvas($width, $height, 'center', false, '#ffffff');

        $img->stream();

        Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');

        return $imageName;
    }
}
