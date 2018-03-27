<?php

namespace BugsLife\QueryNotice\Format\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueryNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $notice;

    /**
     * Create a new message instance.
     * @param $notice
     */
    public function __construct($notice)
    {
        $this->notice = $notice;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        $notice = $this->notice;
        return $this->view('query-notice.mail.query-notice', compact('notice'));
    }
}
