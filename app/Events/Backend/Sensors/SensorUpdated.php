<?php

namespace App\Events\Backend\Sensors;

use App\Models\Sensor\Sensor;
use Illuminate\Queue\SerializesModels;

/**
 * Class SensorUpdated.
 */
class SensorUpdated
{
    use SerializesModels;

    public function __construct(public Sensor $sensor)
    {
    }
}
