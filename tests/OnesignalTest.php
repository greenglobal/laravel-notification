<?php

namespace GGPHP\LaravelNotification\Tests;

use GGPHP\LaravelNotification\Tests\Models\User;
use GGPHP\LaravelNotification\Models\Configuration;
use GGPHP\LaravelNotification\Channels\OnesignalChannel;
use GGPHP\LaravelNotification\Tests\Notification\UserRegisted;
use GGPHP\LaravelNotification\Tests\DataTest;

/**
 * Class BaseTests
 *
 * @package Tests
 */
class OnesignalTest extends TestCase
{
    /**
     * Test configuration creation function.
     */
    public function testSendNotificationViaOnesignal()
    {
        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);
        $user->addDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');

        $data = [
            'start_time' => '5:00',
            'end_time' => '4:00',
            'days_of_the_week' => ['Monday', 'Tuesday']
        ];
        $user->addConfiguration($data);

        $this->assertEquals(null, $user->notify(new UserRegisted));
    }

    /**
     * Test configuration creation function.
     */
    public function testExceptionSendNotificationViaOnesignal()
    {
        $this->expectException('GuzzleHttp\Exception\ClientException');

        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);
        $user->addDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');

        $user->notify(new UserRegisted);
    }
}
