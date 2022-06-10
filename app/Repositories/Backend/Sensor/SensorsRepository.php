<?php

namespace App\Repositories\Backend\Sensor;

use DB;
use Throwable;
use App\Models\Sensor\Sensor;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Sensors\SensorCreated;
use App\Events\Backend\Sensors\SensorDeleted;
use App\Events\Backend\Sensors\SensorUpdated;

class SensorsRepository extends BaseRepository
{
    const MODEL = Sensor::class;

    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'sensors.created_by')
            ->select([
                'sensors.id',
                'sensors.name',
                'sensors.status',
                'sensors.created_by',
                'sensors.created_at',
                'users.name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws Throwable
     * @return Sensor
     */
    public function create(array $input): Sensor
    {
        return DB::transaction(
            function () use ($input) {
                if ($sensor = Sensor::create($input)) {
                    event(new SensorCreated($sensor));

                    return $sensor;
                }

                throw new GeneralException(__('exceptions.backend.sensors.create_error'));
            }
        );
    }

    /**
     * @param Sensor $sensor
     * @param array $input
     * @throws GeneralException
     * @return Sensor|null
     */
    public function update(Sensor $sensor, array $input): ?Sensor
    {
        if ($sensor->update($input)) {
            event(new SensorUpdated($sensor));

            return $sensor->fresh();
        }

        throw new GeneralException(__('exceptions.backend.sensors.update_error'));
    }

    /**
     * @param Sensor $sensor
     *
     * @throws GeneralException
     * @return bool
     */
    public function delete(Sensor $sensor): bool
    {
        if ($sensor->delete()) {
            event(new SensorDeleted($sensor));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.sensors.delete_error'));
    }
}
