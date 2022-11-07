<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Traits\MessengerUsers;
use Flash;

class MessengerShow extends Component
{
    use MessengerUsers;

    private $authUserId;

    public $user;
    public $messages;
    public $message_text;

    public function boot()
    {
        $this->authUserId = Auth::user()->id;
    }

    private function findUserById(int $id)
    {
        $this->user = User::find($id);

        if (empty($this->user)) {
            Flash::error('No user found.');

            return redirect(route('livewire.messenger.index'));
        }
    }

    protected function getMessages()
    {
        $id = $this->user->id;

        Message::where('user_from', $id)
            ->where('user_to', $this->authUserId)
            ->update(['unread' => false]);

        $user_to_messages = Message::where('user_from', $id)->where('user_to', $this->authUserId)->get();
        $user_from_messages = Message::where('user_from', $this->authUserId)->where('user_to', $id)->get();

        $messages = $user_from_messages
            ->merge($user_to_messages)
            ->sortBy('created_at');

        return $messages;
    }

    public function updateMessages()
    {
        $this->messages = $this->getMessages();
    }


    public function mount($id)
    {
        $this->findUserById($id);

        $this->messages = $this->getMessages();
    }

    public function render()
    {
        $users = $this->getUsers();

        $this->getLastMessage($users);

        return view('livewire.messenger.show')
            ->extends('layouts.app')
            ->section('content')
            ->with('users', $users);
    }

    private function createMessage($userToId)
    {
        $message = Message::create([
            'subject' => '#',
            'message_text' => $this->message_text,
            'user_from' => $this->authUserId,
            'user_to' => $userToId,
            'created_at' => now()
        ]);

        if (empty($message)) {
            Flash::error('Message has not been sent.');

            return redirect(route('livewire.messenger.index'));
        }
    }

    public function sendMessage($user_to_id)
    {
        $this->createMessage($user_to_id);

        return redirect(route('livewire.messenger.show', $user_to_id));
    }
}
