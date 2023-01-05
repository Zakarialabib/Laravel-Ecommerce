<?php

declare(strict_types=1);

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
            '/catalog',
            '/categories',
            '/marques',
            '/catalog',
            '/contact',
            '/a-propos',
            '/blog',
            '/faq',
            // URLs for your dynamic pages
            '/marque/slug',
            '/blog/slug',
        ];

        // Generate the sitemap using the defined URLs
        SitemapGenerator::create('http://badrluxury.com')
            ->hasCrawled($urls)
            ->writeToFile(public_path('sitemap.xml'));
    }
}
