<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PersonMessage extends Notification
{
    use Queueable;

    public $user,$content;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$content)
    {
        $this->user=$user;
        $this->content=$content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        if ($this->user)
            return [
            'user_id'=>$this->user->id,
            'user_name'=>$this->user->name,
            'user_avatar'=>$this->user->avatar,
            'content'=>$this->content,
            ];
        else
            return [
                'user_id'=>0,
                'user_name'=>'系统',
                'user_avatar'=>'/storage/uploads/images/system.jpg',
                'content'=>$this->content,
            ];
    }
}
