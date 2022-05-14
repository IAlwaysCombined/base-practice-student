<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ApiHelper;
use App\Http\Resources\StackResource;
use App\Models\Stack;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class StackController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @param  int  $user
     *
     * @return JsonResponse
     */
    public function index(int $user = 0): JsonResponse
    {
        try {
            $stackCurrentUser = Stack::query()->where('user_id',
                User::getUserId())->get();
            $stackUserById    = Stack::query()->where('user_id', $user)->get();
            if ($user == 0) {
                return $this->sendResponse(StackResource::collection($stackCurrentUser),
                    'Stack current user returned.');
            }

            return $this->sendResponse(StackResource::collection($stackUserById),
                'Stack returned.');
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $userId      = User::getUserId();
            $stack       = new Stack();
            $stack->name = $request->name;
            $stack->url  = $request->url;
            $stack->user_id = $userId;
            if ($request->photo) {
                $image     = $request
                    ->file('photo');
                $file_name = Str::random(40).'.'.$image
                        ->extension();
                $image
                    ->move(public_path("images/$userId/stack/image"),
                        $file_name);
                $path = "/images/$userId/stack/image/$file_name";
                $stack
                    ->photo
                      = $path;
            }
            $stack
                ->save();

            return $this->sendResponse(new StackResource($stack),
                'Stack created.');

        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $userId = User::getUserId();
        try {
            $stack = Stack::find($id);
            if ($stack->user_id == User::getUserId()) {
                $stack->name = $request->name;
                $stack->url  = $request->url;
                if ($request->photo) {
                    $image     = $request
                        ->file('photo');
                    $file_name = Str::random(40).'.'.$image
                            ->extension();
                    $image
                        ->move(public_path("images/$userId/stack/image"),
                            $file_name);
                    $path = "/images/$userId/stack/image/$file_name";
                    $stack
                        ->photo
                          = $path;
                }
                $stack
                    ->update();

                return $this->sendResponse(new StackResource($stack),
                    'Stack updated.');

            }

            return ApiHelper::sendError('Stack not found.');
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $stack = Stack::query()->whereId($id);
            if ($stack->user_id = User::getUserId()){
                $result = $stack->delete();
                return $this->sendResponse($result, 'Stack deleted.');
            }
            return ApiHelper::sendError('Stack not found.');
        }catch (\Exception $e){
            return ApiHelper::sendError($e);
        }
    }

}
