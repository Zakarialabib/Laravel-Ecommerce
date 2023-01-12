<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';


    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $sitemapIndex = SitemapIndex::create();

        if (!file_exists(public_path('sitemap'))) {
            mkdir(public_path('sitemap'), 0775, true);
        }

        $productChunks = Product::select(['id', 'slug', 'updated_at'])
            ->active()
            ->chunk(5000, function ($products, $chunk) use ($sitemapIndex) {
                $sitemapName = 'products_sitemap_' . $chunk . '.xml';
                $sitemap = Sitemap::create();

                foreach ($products as $product) {
                    $sitemap->add(Url::create('/catalog' . $product->slug)
                            ->setLastModificationDate($product->updated_at));
                }

                $sitemap->writeToFile(public_path($sitemapName));
                $sitemapIndex->add($sitemapName);
            });

        $subcategories = $this->subcategories();
        $sitemapIndex->add($subcategories);
        
        $brands = $this->brands();
        $sitemapIndex->add($brands);

        $sitemapIndex->writeToFile(public_path('sitemap/sitemap.xml'));
    }

    public function subcategories()
    {
        $subcategories = Subcategory::get();
        $sitemapName = 'subcategories.xml';
        $sitemap = Sitemap::create();
        foreach ($subcategories as $subcategory) {
            $url = 'categories/' . $subcategory->slug;
            $sitemap->add(Url::create($url)
                    ->setLastModificationDate(now()));
        }
        $sitemap->writeToFile(public_path($sitemapName));

        return $sitemapName;
    }
    public function brands()
    {
        $brands = Brand::get();
        $sitemapName = 'brands.xml';
        $sitemap = Sitemap::create();
        foreach ($brands as $brand) {
            $url = 'marque/' . $brand->slug;
            $sitemap->add(Url::create($url)
                    ->setLastModificationDate(now()));
        }
        $sitemap->writeToFile(public_path($sitemapName));

        return $sitemapName;
    }
}
