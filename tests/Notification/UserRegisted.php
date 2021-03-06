<?php

namespace GGPHP\LaravelNotification\Tests\Notification;

use GGPHP\LaravelNotification\BaseNotification;
use GGPHP\LaravelNotification\Channels\OnesignalChannel;

class UserRegisted extends BaseNotification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OnesignalChannel::class, 'database'];
    }

    /**
     * Get the webapp representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return WebappMessage
     */
    public function toOnesignal($notifiable)
    {
        return [
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
