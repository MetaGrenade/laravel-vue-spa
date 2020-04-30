<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class unpublishnotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $recieverId;
    public $blog;
    public function __construct($recieverId,$blog)
    {
        $this->recieverId=$recieverId;
        $this->blog=$blog;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toBroadcast($notifiable)
    {


        return new BroadcastMessage([

                'data'=>$this->blog,
                'type'  =>'unpublishedblock',

                'created_at'      =>  Carbon::now()
            ]
        );

    }
    public function toDatabase($notifiable)
    {
        return [

            'data'=>$this->blog,
            'type'  =>'unpublishedblock',

            'created_at'      =>  Carbon::now()
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.' . $this->recieverId);
    }
}
