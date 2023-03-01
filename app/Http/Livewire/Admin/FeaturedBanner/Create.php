<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\FeaturedBanner;

use App\Models\FeaturedBanner;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createFeaturedBanner = false;

    public $image;

    public $featuredbanner;

    public $listeners = ['createFeaturedBanner'];

    public array $listsForFields = [];

    protected $rules = [
        'featuredbanner.title' => ['required', 'string', 'max:255'],
        'featuredbanner.details' => ['nullable', 'string'],
        'featuredbanner.link' => ['nullable', 'string'],
        'featuredbanner.product_id' => ['nullable', 'integer'],
        'featuredbanner.language_id' => ['nullable', 'integer'],
        'featuredbanner.embeded_video' => ['nullable'],
    ];

    public function mount(FeaturedBanner $featuredbanner)
    {
        $this->featuredbanner = $featuredbanner;
        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('featuredbanner_create'), 403);

        return view('livewire.admin.featured-banner.create');
    }

    public function createFeaturedBanner()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createFeaturedBanner = true;
    }

    public function create()
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->featuredbanner->title).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('featuredbanners', $imageName);
            $this->featuredbanner->image = $imageName;
        }

        $this->featuredbanner->save();

        $this->alert('success', __('FeaturedBanner created successfully.'));

        $this->emit('refreshIndex');

        $this->createFeaturedBanner = false;
    }

    public function initListsForFields()
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
        $this->listsForFields['products'] = Product::pluck('name', 'id')->toArray();
    }
}
