<?php

namespace GGPHP\LaravelNotification\Tests\Notification;

use Faker\Provider\Lorem;
use GGPHP\LaravelNotification\BaseNotification;
use GGPHP\LaravelNotification\Channels\FirebaseChannel;

class UserUpdated extends BaseNotification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FirebaseChannel::class, 'database'];
    }

    /**
     * Get the webapp representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return WebappMessage
     */
    public function toFirebase($notifiable)
    {
        return [
            'title' => 'Lorem',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ];
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
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ];
    }
}
