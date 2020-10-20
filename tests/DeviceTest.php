<?php

namespace GGPHP\LaravelNotification\Tests;

use GGPHP\LaravelNotification\Tests\Models\User;

/**
 * Class BaseTests
 *
 * @package Tests
 */
class DeviceTest extends TestCase
{
    /**
     * Test device creation function.
     */
    public function testCreateFunction()
    {
        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);
        $user->addDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
        $this->assertEquals(1, $user->devices->count());
    }

    /**
     * Test device deletion function.
     */
    public function testDeleteFunction()
    {
        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);
        $user->addDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
        $this->assertEquals(1, $user->devices->count());
        $user->deleteDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
        $user->refresh();
        $this->assertEquals(0, $user->devices->count());
    }

    /**
     * Test device clearing function.
     */
    public function testClearFunction()
    {
        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);
        $user->addDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
        $user->addDevice('b4de36c7-e81d-4690-a15e-c15864b9e2c2');
        $this->assertEquals(2, $user->devices->count());
        $user->clearDevice();
        $user->refresh();
        $this->assertEquals(0, $user->devices->count());
    }

    /**
     * Test device listing function.
     */
    public function testListFunction()
    {
        $user = User::create([
            'name' => 'Nguyen Tri Giang',
            'email' => 'nguyentrigiang1991@gmail.com',
            'password' => '123456'
        ]);
        $user2 = User::create([
            'name' => 'Nguyen Tri Giang 2',
            'email' => 'nguyentrigiang1991_2@gmail.com',
            'password' => '123456'
        ]);
        $user->addDevice('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
        $user->addDevice('b4de36c7-e81d-4690-a15e-c15864b9e2c2');
        $user2->addDevice('15380637-09da-4755-95e2-d53613548716');
        $this->assertEquals(2, $user->devices->count());
        $this->assertEquals(1, $user2->devices->count());
    }
}
