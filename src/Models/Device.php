<?php

namespace GGPHP\LaravelNotification\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    /**
     * Declare the table name
     */
    protected $table = 'notifications_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id'
    ];

    /**
     * Get a device ownership model.
     */
    public function owner()
    {
        return $this->morphTo();
    }
}
