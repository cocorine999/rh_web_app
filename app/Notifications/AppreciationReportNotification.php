<?php

namespace App\Notifications;

use App\Models\Rapport;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppreciationReportNotification extends Notification
{
    use Queueable;
    protected $employee;
    protected $rapport;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $employee, Rapport $rapport)
    {
        $this->employee = $employee;
        $this->rapport = $rapport;
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
            'user_id' => $this->employee->id,
            'user_name' => Str::ucfirst($this->employee->civilite) . " " .$this->employee->last_name . " " .$this->employee->first_name ,
            'rapport_id' => $this->rapport->id,
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
            'created_at' => Carbon::now(),
            'read_at' => null,
            'data' => [
                'user_id' => $this->employee->id,
                'user_name' => Str::ucfirst($this->employee->civilite) . " " .$this->employee->last_name . " " .$this->employee->first_name,
                'rapport_id' => $this->rapport->id,
            ],
        ]);
    }
}
