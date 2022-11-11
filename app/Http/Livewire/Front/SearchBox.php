<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;

class SearchBox extends Component
{

    public $listeners = ['updatedSearch' => 'search'];
    
    public $search = '';
    public $results = [];
    
    public function mount($search = null)
    {
        $this->search = $search;
        $this->results = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function updatedSearch()
    {
        $this->results = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        return view('livewire.front.search-box');
    }


}
