<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Http\Requests\ContactFormRequest;

class InboxMessage extends Notification
{
    use Queueable;
    protected $message;

    public function __construct(ContactFormRequest $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(config('admin.name') . ", dostałeś nowa wiadomość!")
                    ->greeting(" ")
                    ->salutation(" ")
                    ->from($this->message->email, $this->message->name)
                        ->line($this->message->message);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
