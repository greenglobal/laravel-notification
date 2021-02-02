<?php

namespace GGPHP\LaravelNotification\Tests;

use GGPHP\LaravelNotification\Tests\Models\User;
use GGPHP\LaravelNotification\Tests\Notification\UserRegisted;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use GGPHP\LaravelNotification\Tests\Notification\UserUpdated;

/**
 * Class BaseTests
 *
 * @package Tests
 */
class FirebaseTest extends TestCase
{
    protected $idToken = <<<TAG
dYiaDy45ehrTupl3jycYxD:APA91bHBdQGkmpV5e0ch0vomP3CIO3iSbaKsCZ2LB8zn69Mr01BCn-PGAJJJ-EY32ZPwjQyN5QIITzwKgo0cJXBHF0LUx-su49VzbgQVJwjcuRmFfR4o1BryHvaiHndJIcUM9sBL6CX8
TAG;

    /**
     * Test player creation function.
     */
    public function testFunction()
    {
        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);

        $user->addDevice($this->idToken);

        $this->assertEquals(null, $user->notify(new UserUpdated));
    }

    public function send1($messaging) {
        $message = CloudMessage::fromArray([
            'token' => $this->idToken,
            'notification' => ['title' => 'Second message', 'body' => 'Day la noi dung cua message'],
            'data' => ['item' => 'First'],
        ]);

        $a = $messaging->send($message);
    }

    public function send2($messaging) {
        $config = WebPushConfig::fromArray([
            'notification' => [
                'title' => '$GOOG up 1.43% on the day',
                'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
                'icon' => 'https://my-server/icon.png',
            ],
            'fcm_options' => [
                'link' => 'https://my-server/some-page',
            ],
        ]);

        $message = CloudMessage::withTarget('token', $this->idToken)
            ->withWebPushConfig($config);

        $messaging->send($message);
    }

    public function sendToTopic($messaging) {
        $topic = 'a-topic';

        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => ['title' => 'title', 'body' => 'body'],
            'data' => ['123' => '456'],
        ]);

        $messaging->send($message);
    }

    public function subscribeToTopic($messaging) {
        $topic = 'topic-1';
        $messaging->subscribeToTopic($topic, $this->idToken);
    }
}
