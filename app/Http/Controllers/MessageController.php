<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\Order;
use App\Traits\MessageServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class MessageController extends Controller
{
    use MessageServices, forSelector;

    public function __construct()
    {
        //
    }

    public function index(): Factory|View|Application
    {
        $authUserId = auth()->user()->id;

        return view('user_views.messages.index')
            ->with([
                'unreadMessages' => $this->getMessagesByUserId($authUserId),
                'readMessages' => $this->getMessagesByUserId($authUserId, true),
                'myMessages' => $this->getMyMessages($authUserId)
            ]);
    }

    public function create(): Factory|View|Application
    {
        return view('user_views.messages.create')
            ->with([
                'orderList' => $this->userOrderSelector(auth()->user()->id, auth()->user()->type),
                'typeList' => $this->messageTypeSelector()
            ]);
    }

    public function orderUsers(Request $request): array
    {
        try {
            $orderId = $request->orderId;

            return [
                'users' => $this->orderUsersSelector($orderId, auth()->user()->id)
            ];
        }
        catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());

            $status = null;

            if ($exception instanceof HttpExceptionInterface)
                $status = $exception->getStatusCode();

            return [
                'status' => $status,
                'error' => $exception->getMessage()
            ];
        }
    }

    public function store($prefix, CreateMessageRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->createMessageWithUsers($validated);

            return redirect()
                ->route('messages.index', $prefix)
                ->with('success', __('messages.successSentMessage'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function show($prefix, $id): Factory|View|Application
    {
        return view('user_views.messages.show')
            ->with(['message' => $this->getMessageById((int)$id)]);
    }

    public function reply($prefix, $id)
    {

    }

    public function edit($prefix, $id): Factory|View|Application|RedirectResponse
    {
        try {
            $message = $this->getMessageById((int)$id);

            return view('user_views.messages.edit')
                ->with([
                    'message' => $message,
                    'users' => $this->orderUsersSelector($message->order_id, $message->sender_id)
                ]);
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function update($prefix, $id, UpdateMessageRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $message = $this->getMessageById((int)$id);

            $message->topic = $validated['topic'];
            $message->description = $validated['description'];
            $message->updated_at = now();
            $message->save();

            return redirect()
                ->route('messages.index', $prefix)
                ->with('success', __('messages.successUpdateMessage'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function destroy($prefix, $id): RedirectResponse
    {
        try {
            $message = $this->getMessageById((int)$id);

            foreach ($message->messageUsers as $user) {
                $user->delete();
            }

            $replyMessages = $this->getReplyMessagesByMainMessageId((int)$id);

            foreach ($replyMessages as $replyMessage) {
                $replyMessage->delete();
            }

            $message->delete();

            return redirect()
                ->route('messages.index', $prefix)
                ->with('success', __('messages.successDeleteMessage'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function markAsRead($prefix, $id): RedirectResponse
    {
        try {
            $messageUser = $this->getMessageUserByMessageId($id, auth()->user()->id);
            $messageUser->marked_as_read = true;
            $messageUser->save();

            return back()->with('success', __('messages.successMessageRead'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    public function markAllAsRead($prefix): RedirectResponse
    {
        try {
            $messages = $this->getMessageUsersByUserId(auth()->user()->id);

            foreach ($messages as $message) {
                $message->marked_as_read = true;
                $message->save();
            }

            return back()->with('success', __('messages.successMessageRead'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    public function deleteMessagesSetting()
    {

    }
}
