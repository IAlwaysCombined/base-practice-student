<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ApiHelper;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\StudentResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return $this->sendResponse(new StudentResource(User::getUser()),
            'User returned.');
    }

    /**
     * Get one user.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function showStudent(int $id): JsonResponse
    {
        try {
            $user = User::query()
                ->where('id', $id)
                ->where('role_id', 1)
                ->first();

            return $this->sendResponse(new StudentResource($user),
                'Student returned.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $user             = User::getLoggedInUser();
            $user->name       = $request->name;
            $user->surname    = $request->surname;
            $user->patronymic = $request->patronymic;
            $user->phone      = $request->phone;
            $user->bday       = $request->bday;
            $user->update();

            return $this->sendResponse(new StudentResource($user),
                'User updated.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }


    /**
     * Update photo user.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function uploadAvatar(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'avatar' => 'nullable|image',
            ]);
            if ($validator->fails()) {
                $error = $validator->errors()
                    ->all()[0];

                return ApiHelper::sendError($error);
            }

            User::processAvatarUploading($request);

            return $this->sendResponse(User::getLoggedInUser()->avatar,
                'User photo updated.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }


    /**
     * Delete photo user.
     *
     * @return JsonResponse
     */
    public function deleteAvatar(): JsonResponse
    {
        try {
            $user   = User::getLoggedInUser();
            $result = $user->deleteAvatar();

            $user->save();
            if ($result) {
                /** @noinspection PhpConditionAlreadyCheckedInspection */
                return $this->sendResponse($result, 'Photo deleted.');
            }

            return ApiHelper::sendError('Photo not deleted.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Get all students.
     *
     * @return Collection|JsonResponse|array
     */
    public function getStudents(): Collection|JsonResponse|array
    {
        try {
            $user = User::query()->where('role_id', 1)->get();

            return $this->sendResponse(StudentResource::collection($user),
                'Student returned.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Get all companies.
     *
     * @return JsonResponse
     */
    public function getCompanies(): JsonResponse
    {
        try {
            $company = User::query()->where('role_id', 5)->get();

            return $this->sendResponse(CompanyResource::collection($company),
                'Company returned.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

}
