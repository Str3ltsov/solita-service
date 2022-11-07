<?php

namespace App\Traits;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Flash;
use DB;

trait MessengerUsers
{
    protected $userType = 1;

    private function getAuthUserId()
    {
        $this->userType = Auth::user()->type;
        return Auth::user()->id;
    }

    public function getLastMessage(object $users): void
    {
        $authUserId = $this->getAuthUserId();

        foreach ($users as $user) {
            $userToMessages = Message::where('user_from', $user->id)->where('user_to', $authUserId)->get();
            $userFromMessages = Message::where('user_from', $authUserId)->where('user_to', $user->id)->get();

            $user->last_message = $userFromMessages
                ->merge($userToMessages)
                ->sortByDesc('created_at')
                ->first();
        }
    }

    private function getUnreadIds()
    {
        $authUserId = $this->getAuthUserId();
        $unreadIds = DB::select("SELECT user_from AS sender_id,
                                  COUNT(user_from) AS messages_count
                                  FROM messages
                                  WHERE user_to = '$authUserId'
                                  AND unread = true
                                  GROUP BY user_from");
        return collect($unreadIds);
    }

    private function getUsersWithUnreadMessagesCount($users)
    {
        $unreadIds = $this->getUnreadIds();

        return $users->map(function($user) use ($unreadIds) {
            $userUnread = $unreadIds->where('sender_id', $user->id)->first();

            $user->unread = $userUnread ? $userUnread->messages_count : 0;

            return $user;
        });
    }

    public function getUsers()
    {
        $authUserId = $this->getAuthUserId();
        $users = DB::select("SELECT users.id, users.name, users.email,
                             MAX(messages.created_at) FROM users
                             JOIN messages ON (users.id = messages.user_from
                             OR users.id = messages.user_to)
                             WHERE users.id != '$authUserId'
                             AND (messages.user_from = '$authUserId'
                             OR messages.user_to = '$authUserId')"
                             . ($this->userType == 2 ? " AND users.type = 1 " : "") .
                             "GROUP BY users.id, users.name, users.email
                             ORDER BY MAX(messages.created_at) DESC");
        $users = collect($users);
        $users = $this->getUsersWithUnreadMessagesCount($users);

        if (empty($users)) {
            Flash::error('No users found.');
            return redirect(route('livewire.messenger.index'));
        }

        return $users;
    }
}
