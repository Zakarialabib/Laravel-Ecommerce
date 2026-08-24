<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Attributes\Url;

trait WithSorting
{
    #[Url]
    public $sortBy = 'id';

    #[Url]
    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        $this->sortBy = $field;

        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }
}
