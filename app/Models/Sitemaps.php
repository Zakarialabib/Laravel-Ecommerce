<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\SitemapGenerator;

class Sitemaps extends Model
{
    public function generate()
    {
        // Define the URLs that should be included in the sitemap
        $urls = [
            // URLs for your static pages
            '/page-1',
            '/page-2',
            // URLs for your dynamic pages
            '/posts/1',
            '/posts/2',
        ];

        // Generate the sitemap using the defined URLs
        SitemapGenerator::create('http://example.com')
            ->hasCrawled($urls)
            ->writeToFile(public_path('sitemap.xml'));
    }
    
}
