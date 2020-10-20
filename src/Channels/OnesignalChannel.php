<?php

namespace GGPHP\LaravelNotification\Channels;

use Illuminate\Notifications\Notification;
use OneSignal;

class OnesignalChannel
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
        $data = $notification->toOnesignal($notifiable);

        $devices = $notifiable->devices;
        $configuration = $notifiable->configuration;
        $isSend = empty($configuration) ? true : $configuration->isSend(date('Y-m-d H:i'));

        if ($isSend && !empty($devices)) {
            foreach ($devices as $device) {
                $params = $this->prepareParams($data, $device->device_id);
                OneSignal::sendNotificationCustom($params);
            }
        }
    }

    public function prepareParams($data, $deviceId) {
        $contents = [
            "en" => $data['message'] ?? ''
        ];

        $params = [
            'contents' => $contents,
            'include_device_ids' => [$deviceId],
            'data' => $data,
        ];

        if (!empty($data['url'])) {
            $params['url'] = $data['url'];
        }

        if (!empty($data['buttons'])) {
            $params['buttons'] = $data['buttons'];
        }

        if (!empty($data['send_after'])) {
            $params['send_after'] = $data['send_after'];
        }

        if (!empty($data['headings'])) {
            $params['headings'] = [
                "en" => $data['headings']
            ];
        }

        if (!empty($data['subtitle'])) {
            $params['subtitle'] = [
                "en" => $data['subtitle']
            ];
        }

        if (!empty($data['avatar'])) {
            $params['ios_attachments'] = ['image' => $data['image']];
        }

        return $params;
    }
}
