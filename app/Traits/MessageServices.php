<?php

namespace App\Traits;

use App\Models\Message;
use App\Models\MessageUser;
use App\Models\User;

trait MessageServices
{
    public function getMessagesByUserId(int $userId, bool $markedAsRead = false): object|array
    {
        $messages = User::find($userId)->userMessages;

        if (!empty($messages))
            $messages = $messages->where('marked_as_read', $markedAsRead)->sortByDesc('created_at');

        return $messages ?? [];
    }

    public function getMyMessages(int $userId): object|array
    {
        $myMessages = User::find($userId)->myMessages;

        if (count($myMessages) > 0) {
            return $myMessages->toQuery()->orderBy('created_at', 'desc')->paginate(5);
        }

        return [];
    }

    public function getMessageById(int $id): object
    {
        $message = Message::find($id);

        if (empty($message))
            throw new \Error(__('messages.errorMessageNotFound'));

        return $message;
    }

    public function createMessageWithUsers(array $validated): object
    {
        $message = Message::create([
            'topic' => $validated['topic'],
            'description' => $validated['description'],
            'sender_id' => $validated['sender_id'],
            'order_id' => $validated['order_id'],
            'message_type_id' => $validated['message_type_id'],
            'reply_message_id' => $validated['reply_message_id'] ?? NULL,
            'main_message_id' => $validated['main_message_id'] ?? NULL,
            'created_at' => now()
        ]);

        foreach ($validated['users'] as $user) {
            MessageUser::create([
                'message_id' => $message->id,
                'user_id' => (int)$user
            ]);
        }

        return $message;
    }

    public function getMessageUserByMessageId(int $messageId, int $userId): object
    {
        $messageUser = MessageUser::where('message_id', $messageId)
            ->where('user_id', $userId)
            ->first();

        if (empty($messageUser))
            throw new \Error(__('messages.errorMessageUserNotFound'));

        return $messageUser;
    }

    public function getMessageUsersByUserId(int $userId): object
    {
        return MessageUser::where('user_id', $userId)->get();
    }

    public function getReplyMessagesByMainMessageId(int $mainMessageId): object
    {
        return Message::where('main_message_id', $mainMessageId)->get();
    }
}
