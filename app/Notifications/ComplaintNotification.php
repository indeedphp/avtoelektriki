<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintNotification extends Notification
{
    use Queueable;

    public $text;

    public function __construct($text) // получаем из админ контроллера метода create_complaint текст
    {
    $this->text = $text;  
    }

    public function via(object $notifiable): array
    {
        return ['database'];  // настраиваем нотификации на работу с базой данных
    }

    public function toDatabase(object $notifiable): array
    {
    return $this->text;   // отправляем текст жалобы в базу
    }
}
