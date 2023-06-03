<?php

namespace App\Notifications;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Stancl\Tenancy\Database\Models\Domain;

class StoreReadyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Store $store)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $domain = Domain::where('tenant_id', $this->store->subdomain)->first()->domain;

        $url = 'http://' .  $domain . '/login';

        return (new MailMessage)
            ->view('emails.store_ready_mail', ['store' => $this->store, 'url' => $url]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
