<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\MessengerUsers;

class MessengerIndex extends Component
{
    use MessengerUsers;

    public function render()
    {
        $users = $this->getUsers();

        $this->getLastMessage($users);

        return view('livewire.messenger.index')
            ->extends('layouts.app')
            ->section('content')
            ->with('users', $users);
    }
}
