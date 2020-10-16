<?php

namespace GGPHP\LaravelNotification\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use GGPHP\LaravelNotification\HasPlayer;
use GGPHP\LaravelNotification\HasConfiguration;
use GGPHP\LaravelNotification\InteractsWithPlayer;
use GGPHP\LaravelNotification\InteractsWithConfiguration;
use Illuminate\Notifications\Notifiable;

class User extends Model implements HasPlayer, HasConfiguration
{
    use InteractsWithPlayer, InteractsWithConfiguration, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
}
