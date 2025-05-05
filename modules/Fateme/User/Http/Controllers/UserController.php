<?php

namespace Fateme\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Fateme\Media\Services\MediaFileService;
use Fateme\RolePermissions\Repositories\RoleRepo;
use Fateme\User\Http\Requests\AddRoleRequest;
use Fateme\User\Http\Requests\UpdateUserRequest;
use Fateme\User\Models\User;
use Fateme\User\Repositories\UserRepo;
use Responses\AjaxResponses;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {

        $this->userRepo = $userRepo;
    }
    public function index(RoleRepo $roleRepo)
    {
//        if (auth()->check()) {
//            dd(auth()->user());
//        } else {
//            dd('کاربر وارد نشده است');
//        }

        $this->authorize('addRole', User::class);
        $users = $this->userRepo->paginate();
        $roles = $roleRepo->all();
        return view("User::Admin.index", compact('users', 'roles'));
    }
    public function edit($userId)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);
        return view("User::Admin.edit", compact('user'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);

        if ($request->hasFile('image')) {
            $request->request->add(['image_id' => MediaFileService::upload($request->file('image'))->id ]);
            if ($user->banner)
                $user->banner->delete();
        }else{
            $request->request->add(['image_id' => $user->image_id]);
        }

        $this->userRepo->update($userId, $request);
        newFeedback();
        return redirect()->back();
    }


    public function destroy($userId)
    {
        $user = $this->userRepo->findById($userId);
        $user->delete();

        return AjaxResponses::SuccessResponse();
    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify', User::class);
        $user = $this->userRepo->findById($userId);
        $user->markEmailAsVerified();
        return AjaxResponses::SuccessResponse();
    }
    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        newFeedback('موفقیت آمیز', " نقش کاربری {$request->role}  به کاربر {$user->name} داده شد.", 'success');
        return back();
    }

    public function removeRole($userId, $role)
    {
        $this->authorize('removeRole', User::class);
        $user = $this->userRepo->findById($userId);
        $user->removeRole($role);
        return AjaxResponses::SuccessResponse();
    }
}
