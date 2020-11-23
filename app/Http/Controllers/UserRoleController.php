<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleStoreRequest;
use App\Http\Requests\UserRoleUpdateRequest;
use App\Http\Resources\UserRoleCollection;
use App\Http\Resources\UserRoleResource;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserRoleCollection
     */
    public function index(Request $request)
    {
        $userRoles = UserRole::all();

        return new UserRoleCollection($userRoles);
    }

    /**
     * @param \App\Http\Requests\UserRoleStoreRequest $request
     * @return \App\Http\Resources\UserRoleResource
     */
    public function store(UserRoleStoreRequest $request)
    {
        $userRole = UserRole::create($request->validated());

        return new UserRoleResource($userRole);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\userRole $userRole
     * @return \App\Http\Resources\UserRoleResource
     */
    public function show(Request $request, UserRole $userRole)
    {
        return new UserRoleResource($userRole);
    }

    /**
     * @param \App\Http\Requests\UserRoleUpdateRequest $request
     * @param \App\userRole $userRole
     * @return \App\Http\Resources\UserRoleResource
     */
    public function update(UserRoleUpdateRequest $request, UserRole $userRole)
    {
        $userRole->update($request->validated());

        return new UserRoleResource($userRole);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\userRole $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserRole $userRole)
    {
        $userRole->delete();

        return response()->noContent();
    }
}
