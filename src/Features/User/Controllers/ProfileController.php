<?php

namespace Src\Features\User\Controllers;

use Auth;
use Src\Features\User\Resources\UserResource;
use Src\Features\User\Requests\UpdateProfileRequest;
use Src\Features\User\Requests\UploadAvatarRequest;
use Src\Features\User\Services\UserService;
use Src\Shared\Response\AppResponse;
use Storage;

class ProfileController
{
  public function __construct(private readonly UserService $userService) {}

  public function myProfile()
  {
    return AppResponse::ok(new UserResource(Auth::user()));
  }

  public function updateMe(UpdateProfileRequest $request)
  {
    $this->userService->updateUser(Auth::user(), $request->bodyMapped());
    return AppResponse::noContent();
  }

  public function deleteMe()
  {
    $this->userService->deleteUser(Auth::user());
    return AppResponse::noContent();
  }

  public function updateAvatar(UploadAvatarRequest $request)
  {
    $user = Auth::user();
    if ($user->avatar) {
      Storage::delete($user->avatar);
    }
    $file = $request->file("avatar");
    $filePath = Storage::disk("public")->putFileAs("avatar", $file, Auth::user()->id . '.' . $file->getClientOriginalExtension());
    $this->userService->updateUser($user, ["avatar" => $filePath]);
    return AppResponse::noContent();
  }
}
