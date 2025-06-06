<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Twilio\Rest\Client; // For SMS & WhatsApp

class TaskDueNotification extends Notification
{
    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Determine the delivery channels for the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'sms', 'whatsapp']; // Send via mail, sms, and whatsapp
    }

    /**
     * Send the notification via email.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Due: ' . $this->task->title)
            ->line('This is a reminder that your task "' . $this->task->title . '" is due.')
            ->line('Description: ' . $this->task->description)
            ->line('Deadline: ' . $this->task->deadline)
            ->line('Please take action.');
    }

    /**
     * Send the notification via SMS.
     *
     * @param  mixed  $notifiable
     * @return void
     */
    public function toSms($notifiable)
    {
        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $client->messages->create(
            $notifiable->phone_number, // the user's phone number
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => 'Reminder: Your task "' . $this->task->title . '" is due. Please take action.'
            ]
        );
    }

    /**
     * Send the notification via WhatsApp.
     *
     * @param  mixed  $notifiable
     * @return void
     */
    public function toWhatsApp($notifiable)
    {
        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $client->messages->create(
            'whatsapp:' . $notifiable->phone_number, // the user's phone number with 'whatsapp:' prefix
            [
                'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER'),
                'body' => 'Reminder: Your task "' . $this->task->title . '" is due. Please take action.'
            ]
        );
    }
}
