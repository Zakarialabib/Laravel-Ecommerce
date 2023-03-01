<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchBox extends Component
{
    public $listeners = ['updatedSearch' => 'search'];

    public $search = null;

    public $results = [];

    public $searchBox = true;

    protected $queryString = [
        'search' => [
            'except' => '',
            'as' => 'q',
        ],
    ];

    // public function mount($search = null)
    // {
    //     $this->search = $search;
    // }

    public function updatedSearch()
    {
        if (strlen($this->search) > 3) {
            $this->results = Product::active()
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->limit(5)
                ->get();
        } else {
            $this->results = [];
        }
    }

    public function hideSearchResults()
    {
        $this->searchBox = false;
        $this->clearSearch();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->results = [];
    }

    public function render(): View|Factory
    {
        return view('livewire.front.search-box');
    }
}
