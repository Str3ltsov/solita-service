<?php

namespace App\Http\Controllers;

use App\Models\NotificationType;
use App\Models\User;
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
     * System notifications page.
     */
    public function systemNotifications(): Factory|View|Application
    {
        $authUserId = auth()->user()->id;

        return view('user_views.notifications.system_notifications')
            ->with([
                'unreadNotifications' => $this->getNotificationsByUserId(
                    $authUserId,
                    NotificationType::SYSTEM
                ),
                'readNotifications' => $this->getNotificationsByUserId(
                    $authUserId,
                    NotificationType::SYSTEM,
                    true
                )
            ]);
    }

    /*
     * User notification page.
     */
    public function userNotifications(): Factory|View|Application
    {
        $authUserId = auth()->user()->id;

        return view('user_views.notifications.user_notifications')
            ->with([
                'unreadNotifications' => $this->getNotificationsByUserId(
                    $authUserId,
                    NotificationType::USER
                ),
                'readNotifications' => $this->getNotificationsByUserId(
                    $authUserId,
                    NotificationType::USER,
                    true
                )
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

    /*
     * Deletes selected notification by id.
     */
    public function deleteNotification($prefix, int $id): RedirectResponse
    {
        try {
            $notification = $this->getNotificationById($id);
            $notification->delete();

            return back()->with('success', __('messsages.successDeleteNotification'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    public function deleteNotificationsSetting(Request $request): RedirectResponse
    {
        try {
            $user = User::find(auth()->user()->id);

            if ($request->delete_notifications) {
                $user->delete_notifications = true;
                $user->save();

                return back()->with('success', __('messages.successNotificationSettingTrue'));
            }

            $user->delete_notifications = false;
            $user->save();

            return back()->with('success', __('messages.successNotificationSettingFalse'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
