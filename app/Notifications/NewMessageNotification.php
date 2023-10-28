<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;


    protected $user;
    protected $message;
    protected $notification;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Message $message, $notification)
    {
        $this->user = $user;
        $this->message = $message;
        $this->notification = $notification;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }
/*
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->civilite . " " .$this->user->last_name . " " .$this->user->first_name ,
            'message_id' => $this->message->id,
        ];
    } */

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => Str::ucfirst($this->user->civilite) . " " .$this->user->last_name . " " .$this->user->first_name ,
            'message_id' => $this->message->conversation->id,
            'data' => Str::ucfirst(addslashes($this->notification)),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'read_at' => null,
            'created_at' => Carbon::now(),
            'data' => [
                'user_id' => $this->user->id,
                'user_name' => Str::ucfirst($this->user->civilite) . " " .$this->user->last_name . " " .$this->user->first_name ,
                'message_id' => $this->message->conversation->id,
                'data'=> Str::ucfirst(addslashes($this->notification)),
            ],
        ]);
    }
}
