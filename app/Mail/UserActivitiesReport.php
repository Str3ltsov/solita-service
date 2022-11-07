<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserActivitiesReport extends Mailable
{
    use Queueable, SerializesModels;

    private $userActivities;
    public $email;

    public function __construct($userActivities, $email)
    {
        $this->userActivities = $userActivities;
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Users Activities Report')
            ->markdown('user_activities_report.email', [
                'userActivities' => $this->userActivities
            ]);
    }
}
