<?php

namespace App\Services;

use App\Interfaces\ScraperInterface;
use Goutte\Client;

class MyScraper implements ScraperInterface
{
    private $crawler;

    public function __construct()
    {
        $this->crawler = new Client();
    }

    public function scrape(string $url): void
    {
        $this->crawler->request('GET', $url);
    }

    public function extract(): array
    {
        $products = [];
        // dd($this);
        $productNodes = $this->crawler->filter('div.wp-block-image');

        $productNodes->each(function ($productNode) use (&$products) {
            $img = $productNode->filter('img')->attr('src');
        $productCode = $productNode->filter('figcaption a')->text();
        $productLink = $productNode->filter('figcaption a')->attr('href');

            $product = [
                'img' => $img,
                'product_code' => $productCode,
                'link' => $productLink
            ];

            $products[] = $product;
        });

        return $products;
    }

    public function scrapeProductDetails(string $url): array
    {
        $this->crawler->request('GET', $url);
        
        $name = $this->crawler->filterXPath('//h1[@class="entry-title"]')->text();
        $gallery = $this->crawler->filterXPath('//figure[contains(@class, "featured-media")]/img')->each(function ($node) {
            $imageUrl = $node->attr('src');
            $imageName = basename($imageUrl);
            $imagePath = 'images/' . $imageName; // change the directory and image name as per your requirement
            $client = new Client();
            $client->request('GET', $imageUrl, ['sink' => $imagePath]);
            return $imageUrl;
        });
        
        return [
            'name' => $name,
            'gallery' => $gallery
        ];
    }
    
}
