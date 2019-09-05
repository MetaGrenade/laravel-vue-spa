<?php

namespace App\Mail;

use App\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HolidayWishes extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $template = 'holiday-wishes';
        $email_patterns = array(
            'name' => $this->data->name,
        );

        $finilizedEmail = EmailTemplates::replaceEmailVariables($template, $email_patterns);

        return $this->from(env('MAIL_USERNAME'))
            ->subject($finilizedEmail['subject'])
            ->view('emails.holiday-wishes')
            ->with('content', $finilizedEmail['content']);
    }
}
