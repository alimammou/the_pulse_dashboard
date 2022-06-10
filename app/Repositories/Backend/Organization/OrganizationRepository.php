<?php

namespace App\Repositories\Backend\Organization;

use App\Models\OrganizationCoalition\OrganizationCoalition;
use App\Storages\FileHandler;
use App\Storages\FileStorageFactory;
use DB;
use Illuminate\Support\Str;
use Throwable;
use App\Models\Organization\Organization;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Organizations\OrganizationDeleted;
use App\Events\Backend\Organizations\OrganizationUpdated;
use App\Events\Backend\Organizations\OrganizationCreated;

class OrganizationRepository extends BaseRepository
{
    const MODEL = Organization::class;
    private FileHandler $file_handler;

    public function __construct()
    {
        $this->file_handler = new FileHandler(FileStorageFactory::createForOrganizations());
    }


    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'organizations.created_by')
            ->select([
                'organizations.id',
                'organizations.name',
                'organizations.created_by',
                'organizations.created_at',
                'users.name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws Throwable
     * @return Organization
     */
    public function create(array $input): Organization
    {
        $input['slug']= Str::slug($input['name']);
        $input = $this->file_handler->create(
            input: $input,
            uploaded_file_field: 'logo',
            file_field: 'logo_name'
        );
        $input = $this->file_handler->create(
            input: $input,
            uploaded_file_field: 'economic_plan_upload',
            file_field: 'economic_plan_file'
        );

        if ($organization = Organization::create($input)) {
                    event(new OrganizationCreated($organization));

                    return $organization;
                }

                throw new GeneralException(__('exceptions.backend.organizations.create_error'));


    }

    /**
     * @param Organization $organization
     * @param array $input
     * @throws GeneralException
     * @return Organization|null
     */
    public function update(Organization $organization, array $input): ?Organization
    {
        $input = $this->file_handler->update(
            input: $input,
            uploaded_file_field: 'logo',
            file_field: 'logo_name',
            old_file_name: $organization->logo_name,
        );
        $input = $this->file_handler->update(
            input: $input,
            uploaded_file_field: 'economic_plan_upload',
            file_field: 'economic_plan_file',
            old_file_name: $organization->economic_plan_file,
        );
       $input['slug']= Str::slug($input['name']);


        if ($organization->update($input)) {
            event(new OrganizationUpdated($organization));

            return $organization->fresh();
        }

        throw new GeneralException(__('exceptions.backend.organizations.update_error'));
    }

    /**
     * @param Organization $organization
     *
     * @throws GeneralException
     * @return bool
     */
    public function delete(Organization $organization): bool
    {
        $connections=OrganizationCoalition::where('organization_id',$organization->id)->get();
        foreach ($connections as $connection)
        {
            $connection->delete();
        }
        if ($organization->delete()) {
            event(new OrganizationDeleted($organization));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.organizations.delete_error'));
    }
}
