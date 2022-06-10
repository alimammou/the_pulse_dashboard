<?php

namespace App\Listeners\Backend\Sensors;

use Illuminate\Events\Dispatcher;
use App\Events\Backend\Sensors\SensorCreated;
use App\Events\Backend\Sensors\SensorDeleted;
use App\Events\Backend\Sensors\SensorUpdated;

class SensorEventListener
{
    private string $history_slug = 'Sensor';

    public function onCreated(SensorCreated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->sensor->id)
            ->withText('trans("history.backend.sensors.created") <strong>'.$event->sensor->name.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    public function onUpdated(SensorUpdated $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->sensor->id)
            ->withText('trans("history.backend.sensors.updated") <strong>'.$event->sensor->name.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    public function onDeleted(SensorDeleted $event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->sensor->id)
            ->withText('trans("history.backend.sensors.deleted") <strong>'.$event->sensor->name.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            SensorCreated::class => 'onCreated',
            SensorUpdated::class => 'onUpdated',
            SensorDeleted::class => 'onDeleted',
        ];
    }
}
