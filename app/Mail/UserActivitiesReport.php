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

    public function __construct($userActivities)
    {
        $this->userActivities = $userActivities;
    }

    private function getAndSetSubject(): string
    {
        $subject = '';

        if (app()->getLocale() == 'lt')
            $subject = 'Vartotojo veiksmai ataskaita';
        if (app()->getLocale() == 'ru')
            $subject = 'Отчет о действиях пользователей';
        if (app()->getLocale() == 'en')
            $subject = 'User activities report';

        return $subject;
    }

    public function build()
    {
        return $this
            ->subject($this->getAndSetSubject())
            ->markdown('user_activities_report.email', [
                'userActivities' => $this->userActivities
            ]);
    }
}
