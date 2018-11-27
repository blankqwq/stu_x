<?php

namespace App\Notifications;

use App\Models\Classes;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClassCreate extends Notification
{
    use Queueable;

    public $classe;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Classes $classes)
    {
        $this->classe=$classes;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
        $id = $this->classe->id;

        // 存入数据库里的数据
        return [
            'creator_id' => $this->reply->id,
            'class_name' => $this->reply->content,
            'class_avatar' => $this->reply->user->id,
            'user_name' => $this->reply->user->name,
            'user_avatar' => $this->reply->user->avatar,
//            'topic_link' => $link,
//            'topic_id' => $topic->id,
        ];
    }
}
