<?php

namespace App\Repositories\Backend\Change;

use App\Events\Backend\Organizations\OrganizationUpdated;
use App\Models\Organization\Organization;
use App\Storages\FileHandler;
use App\Storages\FileStorageFactory;
use DB;
use Illuminate\Support\Str;
use Throwable;
use App\Models\Change\Change;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

class ChangeRepository extends BaseRepository
{
    const MODEL = Change::class;
    public function __construct()
    {

    }


    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'changes.created_by')
            ->where('changes.status','pending')
            ->select([
                'changes.id',
                'changes.values',
                'changes.status',
                'changes.created_by',
                'changes.created_at',
                'users.name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws Throwable
     * @return Change
     */
    public function create(array $input,$id): Change
    {
$input=json_encode($input);
        if ($change = Change::create(['values'=>$input,'status'=>'pending','organization_id'=>$id])) {

            return $change;
        }

        throw new GeneralException(__('exceptions.backend.organizations.create_error'));


    }
    public function approve(Change $change, array $input)
    {


        if ($change->update(['status'=>'approved'])) {
     $organization=Organization::where('id',$change->organization_id)->update();

            return $change->fresh();
        }

        throw new GeneralException(__('exceptions.backend.organizations.update_error'));
    }
}
