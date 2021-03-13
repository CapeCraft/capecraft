<?php

namespace App\Mail;

use App\Models\UnbanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnbanRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The unban instance.
     *
     * @var \App\Models\Order
     */
    public $unbanRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UnbanRequest $unbanRequest) {
        $this->unbanRequest = $unbanRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->replyTo($this->unbanRequest->email, $this->unbanRequest->username)->markdown('unban_email', [ 'unbanRequest' => $this->unbanRequest ]);
    }
}
