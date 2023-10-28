<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use App\Models\Paiement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmPayNotification extends Notification
{
    use Queueable;
    protected $employee;
    protected $paiement;
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $employee, Paiement $paiement,bool $status)
    {
        $this->employee = $employee;
        $this->paiement = $paiement;
        $this->status = $status;
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
                'paiement_id' => $this->paiement->id,
                'status' => $this->status,
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
                'paiement_id' => $this->paiement->id,
                'status' => $this->status,
            ],
        ]);
    }
}
