<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;

use App\Models\Message;
use App\Models\Demand;
use Livewire\Component;

class Chat extends Component
{
    public $messageText;
    public $demand;

    public function render()
    {
        $demand = Demand::findOrFail($this->demand);
        $messages = $demand->messages()->latest()->take(10)->get()->sortBy('id');
        return view('livewire.chat')->with(compact('messages'));
    }

    public function sendMessage()
    {
        $demand = Demand::findOrFail($this->demand);
        $demand->messages()->create([
            'user_id' => auth()->user()->id,
            'message' => $this->messageText,
        ]);

        $this->messageText = '';
    }
}
