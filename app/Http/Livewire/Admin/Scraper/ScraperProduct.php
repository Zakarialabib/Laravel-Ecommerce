<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Scraper;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Services\MyScraper;
use App\Models\Product;
use Goutte\Client;
use Spekulatius\PHPScraper\PHPScraper;

class ScraperProduct extends Component
{
    public $url = 'https://casiofanmag.com/standard/';
    public $products = [];
    public $newProductUrl;

    public function scrape()
    {
        $client = new Client();

        $crawler = $client->request('GET', $this->url);

        $products = [];
        $productNodes = $crawler->filter(".wp-block-gallery-4");

        $productNodes->each(function ($productNode) use (&$products) {
            $img = $productNode->filter('figure.wp-block-image.size-large > img')->attr('src');
            $productCode = $productNode->filter('figcaption > a')->text();
            $productLink = $productNode->filter('figcaption > a')->attr('href');

            $products[] = [
                'img' => $img,
                'code' => $productCode,
                'link' => $productLink
            ];
        });
        // dd($products);
        $this->products = $products;
    }

    public function addProduct($code,$link)
    {
        $client = new Client();
        $crawler = $client->request('GET', $link);

        $name = $crawler->filterXPath('//h1[@class="entry-title"]')->text();
        $gallery = $crawler->filterXPath('//figure[contains(@class, "featured-media")]/img')->each(function ($node) {
            $imageUrl = $node->attr('src');
            $imageName = basename($imageUrl);
            $imagePath = 'images/' . $imageName; // change the directory and image name as per your requirement
            $client = new Client();
            $client->request('GET', $imageUrl, ['sink' => $imagePath]);
            return $imageUrl;
        });
        dd($gallery );
        $product = new Product();
        $product->name = $name;
        $product->code = $code;
        $product->img = $this->newProductImg;
        $product->status = 0;
        $product->gallery = json_encode($gallery); // encode the gallery array as a JSON string

        // Save the product to the database
        $product->save();

        $this->products[] = $product;

        $this->reset(['newProductUrl', 'newProductImg', 'newProductCode']);
    }

    public function render(): View
    {
        return view('livewire.admin.scraper.scraper-product');
    }
}
