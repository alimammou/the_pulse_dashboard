<?php

namespace App\Repositories\Backend\Coalition;

use App\Models\OrganizationCoalition\OrganizationCoalition;
use App\Storages\FileHandler;
use App\Storages\FileStorageFactory;
use DB;
use Illuminate\Support\Str;
use Throwable;
use App\Models\Coalition\Coalition;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
class CoalitionRepository extends BaseRepository
{
    const MODEL = Coalition::class;

    public function __construct()
    {
    }


    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'coalitions.created_by')
            ->select([
                'coalitions.id',
                'coalitions.name',
                'coalitions.created_by',
                'coalitions.created_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws Throwable
     * @return Coalition
     */
    public function create(array $input): Coalition
    {
        if ($coalition = Coalition::create($input)) {

            return $coalition;
        }

        throw new GeneralException(__('exceptions.backend.coalitions.create_error'));


    }

    /**
     * @param Coalition $coalition
     * @param array $input
     * @throws GeneralException
     * @return Coalition|null
     */
    public function update(Coalition $coalition, array $input): ?Coalition
    {
        if ($coalition->update($input)) {

            return $coalition->fresh();
        }

        throw new GeneralException(__('exceptions.backend.coalitions.update_error'));
    }

    /**
     * @param Coalition $coalition
     *
     * @throws GeneralException
     * @return bool
     */
    public function delete(Coalition $coalition): bool
    {
        $connections=OrganizationCoalition::where('coalition_id',$coalition->id)->get();
        foreach ($connections as $connection)
        {
            $connection->delete();
        }
        if ($coalition->delete()) {

            return true;
        }

        throw new GeneralException(__('exceptions.backend.coalitions.delete_error'));
    }
}
