<?php

namespace App\Http\Controllers\Backend\Auth\User;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;

class UsersAutoCompleteController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ManageUserRequest $request): JsonResponse
    {
        $param = $request->all()['q'] ?? null;

        $data = $this->repository->getAutoCompletePaginated($param);

        return response()->json($data->all());
    }
}
