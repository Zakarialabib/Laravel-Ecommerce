<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Notifications extends Component
{

    public $notifications;

    public function render()
    {
        return view('livewire.notifications');
    }

    public function mount(){
        $this->notifications = auth()->user()->notifications->take(10);    
    }
   
    public function toggleReadStatus($key){
       
        $notification = $this->notifications[$key];
       
        $notification->read_at === null ? $notification->read_at = Carbon::now()->toTimeString() : $notification->read_at = null;
        $notification->save();
        
    }
}