<?php

namespace GGPHP\LaravelNotification\Channels;

use Illuminate\Notifications\Notification;
use OneSignal;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toFirebase($notifiable);

        $messaging = app('firebase.messaging');
    
        $players = $notifiable->players;
    
        if (!empty($players)) {
            foreach ($players as $player) {
               $message = CloudMessage::fromArray([
                    'token' => $player->player_id,
                    'notification' => ['title' => $data['title'], 'body' => $data['message']],
                    'data' => $data,
               ]);
                $messaging->send($message);
            }
        }
    }
}
