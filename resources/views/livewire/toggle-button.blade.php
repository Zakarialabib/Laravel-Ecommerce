<div>
    <x-toggle-switch name="status" wire:model.lazy="status" 
                    wire:key="toggle-{{ $model->id }}"
                    class="text-white" id="{{$uniqueId}}" 
                    checked="{{$status}}"/>
</div>

  