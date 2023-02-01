<?php

namespace App\Http\Controllers;

use App\Traits\NotificationServices;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    use NotificationServices;

    /*
     * Main page for notifications.
     */
    public function index(): Factory|View|Application
    {
        $authUserId = auth()->user()->id;

        return view('user_views.notifications.index')
            ->with([
                'unreadNotifications' => $this->getUnreadNotificationsByUserId($authUserId),
                'readNotifications' => $this->getReadNotificationsByUserId($authUserId)
            ]);
    }

    /*
     * Sets a notification mark_as_read to true.
     */
    public function markAsRead($prefix, int $id): RedirectResponse
    {
        try {
            $notification = $this->getNotificationById($id);
            $notification->marked_as_read = true;
            $notification->save();

            return back()->with('success', __('messages.successNotificationRead'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Sets all notifications mark_as_read to true.
     */
    public function markAllAsRead($prefix): RedirectResponse
    {
        try {
            $notifications = $this->getUnreadNotificationsByUserId(auth()->user()->id);

            foreach ($notifications as $notification) {
                $notification->marked_as_read = true;
                $notification->save();
            }

            return back()->with('success', __('messages.successNotificationsRead'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
