<?php

namespace App\Livewire;

use App\Models\message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public User $id;
    public $message = '';
    public function render()
    {
        // $messages = message::where('from_user_id', Auth::user()->id)
        // ->orWhere('from_user_id', $this->id->id)
        // ->orWhere('to_user_id', Auth::user()->id)
        // ->orWhere('to_user_id', $this->id->id)
        // ->get();

        $name = User::findOrFail($this->id->id)->name;

        $messages = message::where(function($query){
            $query->where('from_user_id', Auth::user()->id)
            ->where('to_user_id', $this->id->id);
        })
        ->orWhere(function($query){
            $query->where('from_user_id', $this->id->id)
            ->where('to_user_id', Auth::user()->id);
        })
        ->get();

        return view('livewire.chat', compact('messages', 'name'));
    }

    public function sendMessage() {
        // dd($this->id->id);

        $messager = new message();

        $messager->from_user_id = Auth::user()->id;
        $messager->to_user_id = $this->id->id;
        $messager->message = $this->message;
        $messager->save();

        $this->reset('message');
    }
}
