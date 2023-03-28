<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsersReport extends Mailable
{
    use Queueable, SerializesModels;

    private $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    private function getAndSetSubject(): string
    {
        $subject = '';

        if (app()->getLocale() == 'lt')
            $subject = 'Naudotojų ataskaita';
        if (app()->getLocale() == 'ru')
            $subject = 'Отчет о пользователях';
        if (app()->getLocale() == 'en')
            $subject = 'Users report';

        return $subject;
    }

    public function build()
    {
        return $this
            ->subject($this->getAndSetSubject())
            ->markdown('users_report.email', [
                'users' => $this->users
            ]);
    }
}
