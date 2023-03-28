<?php

namespace App\Interfaces;

interface ScraperInterface
{
    public function scrape(string $url): void;
    public function extract(): array;
}
