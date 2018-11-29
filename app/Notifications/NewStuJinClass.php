<?php

namespace App\Notifications;

use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewStuJinClass extends Notification
{
    use Queueable;

    public $classuser;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ClassUser $classUser)
    {
       $this->classuser=$classUser;
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


    /**
     * 数据库发送逻辑
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $user=User::find($this->classuser->user_id);
        $class=Classes::find($this->classuser->class_id);

        //信息内容
        return [
            'classuser_id'=>$this->classuser->id,
            'user_id' => $user->id,
            'class_id' =>$this->classuser->class_id,
            'user_name' =>$user->name,
            'user_avatar' => $user->avatar,
            'token' => $this->classuser->token,
            'class_name' => $class->name,
            'class_avatar' => $class->avatar,
        ];
    }
}
