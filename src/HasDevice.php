<?php

namespace GGPHP\LaravelNotification;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasDevice
{
    public function devices(): MorphMany;

    /**
     * Add a device to owner.
     *
     * @param string $device_id
     *
     * @return \GGPHP\GGNotifications\Models\Device
     */
    public function addDevice($device_id);

    /**
     * Delete the associated device with device_id.
     *
     * @param string $device_id
     *
     * @return int
     */
    public function deleteDevice($device_id);

    /**
     * Clear the associated devices.
     *
     * @return int
     */
    public function clearDevice();
}
