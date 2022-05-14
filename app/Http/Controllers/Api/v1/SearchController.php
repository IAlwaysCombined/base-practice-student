<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ApiHelper;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\StudentResource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SearchController extends BaseController
{

    /**
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function company(Request $request
    ): Response|JsonResponse|Application|ResponseFactory {
        try {
            $searchQuery = $request->get('search_query');
            if ( ! $searchQuery) {
                return ApiHelper::sendError('Query is empty.');
            }

            $paginate = User::query()
                ->where(DB::raw("name"), 'LIKE', "%{$searchQuery}%")
                ->where('role_id', 5)
                ->simplePaginate();


            return response([
                'success' => true,
                'data'    => CompanyResource::collection($paginate),
                'message' => 'Company retrieved successfully.',
                'info'    => [
                    'next'           => $paginate->nextPageUrl(),
                    'prev'           => $paginate->previousPageUrl(),
                    'has_more_pages' => $paginate->hasMorePages(),
                    'count'          => $paginate->count(),
                ],
            ], 200);

        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * @param  Request  $request
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function student(Request $request
    ): Response|JsonResponse|Application|ResponseFactory {
        try {
            $searchQuery = $request->get('search_query');
            if ( ! $searchQuery) {
                return ApiHelper::sendError('Query is empty.');
            }

            $paginate = User::query()
                ->where(DB::raw("concat(name, ' ', surname)"), 'LIKE',
                    "%{$searchQuery}%")
                ->where('role_id', 1)
                ->simplePaginate();


            return response([
                'success' => true,
                'data'    => StudentResource::collection($paginate),
                'message' => 'Company retrieved successfully.',
                'info'    => [
                    'next'           => $paginate->nextPageUrl(),
                    'prev'           => $paginate->previousPageUrl(),
                    'has_more_pages' => $paginate->hasMorePages(),
                    'count'          => $paginate->count(),
                ],
            ], 200);

        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

}
