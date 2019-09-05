<?php

namespace App\Mail;

use App\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateNewUser extends Mailable
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

        //dd($this->data[0]->activation_key);

        $template = 'new-user-created';
        $email_patterns = array(
            'name' => $this->data[0]->name,
            'site_url' => env('APP_URL'),
            'url' => env('APP_URL') . 'set-password/' . $this->data[0]->activation_key,
        );

        $finilizedEmail = EmailTemplates::replaceEmailVariables($template, $email_patterns);

        //dd($finilizedEmail['subject']);

        return $this->from(env('MAIL_USERNAME'))
            ->subject($finilizedEmail['subject'])
            ->view('emails.create-new-user')
            ->with('content', $finilizedEmail['content']);
    }
}
