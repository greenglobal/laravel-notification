[![Commitizen friendly](https://img.shields.io/badge/commitizen-friendly-brightgreen.svg)](http://commitizen.github.io/cz-cli/)


# Introduction

This is a simple Notification wrapper library for Laravel. It simplifies the basic
notification flow with the defined methods. You can send a message to all users
or you can notify a single user, manage notifications, devices ID, and configure time to receive notifications.

# Installation

First, you'll need to require the package with Composer:

```sh
composer require greenglobal/laravel-notification
```
The package will automatically register a service provider.


Then, run `php artisan vendor:publish --provider="GGPHP\LaravelNotification\NotificationServiceProvider"` from your command line to publish the notification migration and configuration files.


Finally, from the command line again, run

```
php artisan migrate
```


# Configuration
After publishing Notification's assets, its primary configuration file will be located at config/notification.php. This configuration file allows you to configure type of ID used for the notification.
> **Note:** Please make sure you change the type of the ID column in the notifications table according to the type of ID configured.


If you use Onesignal, run

```sh
php artisan vendor:publish --tag=config
```
to publish the default configuration file. This will publish a configuration file named onesignal.php which includes your OneSignal authorization keys.

You need to fill in onesignal.php file that is found in your applications config directory. app_id is your OneSignal App ID and rest_api_key is your REST API Key.


# USAGE

## Preparing your model:
To associate notification with a model, the model must implement the following interface and trait

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GGPHP\LaravelNotification\HasPlayer;
use GGPHP\LaravelNotification\HasConfiguration;
use GGPHP\LaravelNotification\InteractsWithPlayer;
use GGPHP\LaravelNotification\InteractsWithConfiguration;
use Illuminate\Notifications\Notifiable;

class User extends Model implements HasPlayer, HasConfiguration
{
    use InteractsWithPlayer, InteractsWithConfiguration, Notifiable;
}
```

## Creating Notifications:
```sh
php artisan make:notification InvoicePaid
```
Extends `GGPHP\LaravelNotification\BaseNotification` instead of `Illuminate\Notifications\Notification`
```php
use GGPHP\LaravelNotification\BaseNotification;

class UserRegisted extends BaseNotification
{
}
```

## Sending Notifications:

```php
use App\Notifications\InvoicePaid;

$user->notify(new InvoicePaid($invoice));
```

## Accessing The Notifications
```php
$user = App\Models\User::find(1);

foreach ($user->notifications as $notification) {
    echo $notification->type;
}
```


## Interacts with Player
```php
$user->addPlayer('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
$players = $user->players;
$user->deletePlayer('5ea79c81-327f-4d8b-98b1-58dbd22a277b');
$user->clearPlayer();
```


## Interacts with Configuration
```php
$data = [
    'start_time' => '5:00',
    'end_time' => '21:59',
    'days_of_the_week' => ['Monday', 'Tuesday']
];
$user->addConfiguration($data);
$user->resetConfiguration();
```
