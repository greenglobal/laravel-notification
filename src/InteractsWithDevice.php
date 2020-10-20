<?php

namespace GGPHP\LaravelNotification;

use GGPHP\LaravelNotification\Models\Device;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait InteractsWithDevice
{
    public function devices(): MorphMany
    {
        return $this->morphMany(Device::class, 'owner');
    }

    /**
     * Add a device to owner.
     *
     * @param $device_id
     */
    public function addDevice($device_id)
    {
        return $this->devices()->firstOrCreate(['device_id' => $device_id]);
    }

    /**
     * Delete the associated device with device_id.
     *
     * @param $device_id
     */
    public function deleteDevice($device_id)
    {
        return $this->devices()->where('device_id', $device_id)->delete();
    }

    /**
     * Clear the associated devices.
     *
     * @param $device_id
     */
    public function clearDevice()
    {
        return $this->devices()->delete();
    }
}
