<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnsReport extends Mailable
{
    use Queueable, SerializesModels;

    private $returns;
    private $returnItems;
    public $email;

    public function __construct($returns, $returnItems, $email)
    {
        $this->returns = $returns;
        $this->returnItems = $returnItems;
        $this->email = $email;
    }

    public function build()
    {
        return $this
            ->subject('Returns Report')
            ->markdown('returns_report.email', [
                'returns' => $this->returns,
                'returnItems' => $this->returnItems
            ]);
    }
}
