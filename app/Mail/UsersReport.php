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
    public $email;

    public function __construct($users, $email)
    {
        $this->users = $users;
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Users Report')
            ->markdown('users_report.email', [
                'users' => $this->users
            ]);
    }
}
