<?php

namespace Brackets\AdminAuth\Activation\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivationNotification extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //TODO change to template?
        return (new MailMessage)
            ->line(trans('craftable/admin-auth::activations.email.line'))
            ->action(trans('craftable/admin-auth::activations.email.action'), route('craftable/admin-auth::admin/activation/activate', $this->token))
            ->line(trans('craftable/admin-auth::activations.email.notRequested'));
    }
}
