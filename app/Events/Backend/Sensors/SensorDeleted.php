<?php

namespace App\Events\Backend\Sensors;

use App\Models\Sensor\Sensor;
use Illuminate\Queue\SerializesModels;

/**
 * Class SensorDeleted.
 */
class SensorDeleted
{
    use SerializesModels;

    public function __construct(public Sensor $sensor)
    {
    }
}
