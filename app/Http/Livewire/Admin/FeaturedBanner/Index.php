<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\FeaturedBanner;

use App\Models\FeaturedBanner;
use App\Http\Livewire\WithSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Featured Banner')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    #[Url]
    public string $search = '';

    #[Url]
    public int $perPage = 25;

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    /** @var array<int, string> */
    public array $selected = [];

    public function mount(): void
    {
        $this->authorize('featuredbanner_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new FeaturedBanner())->orderable;
    }

    #[Computed]
    public function featuredBanners(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return FeaturedBanner::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])->paginate($this->perPage);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

   #[Computed]
    public function selectedCount(): int
    {
        return count($this->selected);
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.featuredbanner.index', [
            'featuredBanners' => $this->featuredBanners,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
    
    public function setFeatured($id)
    {
        FeaturedBanner::where('featured', '=', true)->update(['featured' => false]);
        $featuredbanner = FeaturedBanner::findOrFail($id);
        $featuredbanner->featured = true;
        $featuredbanner->save();

        $this->alert('success', __('Featuredbanner featured successfully!'));
    }

    public function editModal(FeaturedBanner $featuredbanner)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->featuredbanner = $featuredbanner;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();
        // if product selected Helpers::productLink($product)

        if ($this->image) {
            $imageName = Str::slug($this->featuredbanner->title).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('featuredbanners', $imageName);
            $this->featuredbanner->image = $imageName;
        }

        $this->featuredbanner->save();

        $this->alert('success', __('FeaturedBanner updated successfully.'));

        $this->editModal = false;
    }

    public function showModal(FeaturedBanner $featuredbanner)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->featuredbanner = $featuredbanner;

        $this->showModal = true;
    }

    public function delete(FeaturedBanner $featuredbanner)
    {
        $featuredbanner->delete();

        $this->alert('success', __('FeaturedBanner deleted successfully.'));
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
        $this->listsForFields['products'] = Product::pluck('name', 'id')->toArray();
    }
}
