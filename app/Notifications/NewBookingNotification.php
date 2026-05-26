<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingNotification extends Notification
{
    use Queueable;
    
    protected $booking;
    
    public function __construct($booking)
    {
        $this->booking = $booking;
    }
    
    public function via($notifiable)
    {
        return ['mail'];
    }
    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Новое бронирование в ресторане AAA')
            ->greeting('Здравствуйте!')
            ->line('Поступила новая заявка на бронирование столика:')
            ->line('**Имя:** ' . $this->booking->guest_name)
            ->line('**Телефон:** ' . $this->booking->phone)
            ->line('**Email:** ' . ($this->booking->email ?: 'не указан'))
            ->line('**Дата:** ' . $this->booking->date)
            ->line('**Время:** ' . $this->booking->time)
            ->line('**Количество гостей:** ' . $this->booking->guests_count)
            ->action('Перейти в админ-панель', url('/admin/bookings'))
            ->line('Пожалуйста, подтвердите бронирование.');
    }
}