<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\PortfolioResource;
use App\Models\Photo;
use App\Models\PhotoPortfolio;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class PortfolioController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $user
     * @return JsonResponse
     */
    public function index(int $user = 0): JsonResponse
    {
        try {
            if ($user == 0) {
                return $this->sendResponse(PortfolioResource::collection(Portfolio::query()->where('user_id', User::getUserId())->get()), 'Portfolio returned.');
            } else {
                return $this->sendResponse(PortfolioResource::collection(Portfolio::query()->where('user_id', $user)->get()), 'Portfolio returned.');
            }
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $portfolio = new Portfolio();
            $portfolio->user_id = User::getUserId();
            $portfolio->name = $request->name;
            $portfolio->description = $request->description;
            $portfolio->url = $request->url;
            $result = $portfolio->save();
            if ($result) {
                return $this->sendResponse(new PortfolioResource($portfolio), 'Portfolio created.');
            } else {
                return ApiHelper::sendError('Portfolio not created.');
            }
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Store a newly created photo resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function storePhoto(Request $request, int $id): JsonResponse
    {
        try {
            $photo = Photo::createPhoto($request,"portfolio/{$id}");
            $photoPortfolio = new PhotoPortfolio();
            $photoPortfolio->portfolio_id = $id;
            $photoPortfolio->photo_id = $photo->id;
            $photoPortfolio->save();
            return $this->sendResponse(new PhotoResource($photo), 'Photo added to portfolio.');
        }catch (\Exception $e){
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $portfolio = Portfolio::query()->find($id);
            $portfolio->name = $request->name;
            $portfolio->description = $request->description;
            $portfolio->url = $request->url;
            $portfolio->update();
            return $this->sendResponse(new PortfolioResource($portfolio), 'Portfolio updated.');
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Delete photo the specified resource in storage.
     *
     * @param $id_portfolio
     * @param $id_photo
     * @return JsonResponse
     */
    public function deletePhoto($id_portfolio, $id_photo): JsonResponse
    {
        $portfolio = Portfolio::query()->find($id_portfolio);
        if ($portfolio->user_id == User::getUserId()){
            $image = $portfolio->photo->find($id_photo);
            File::delete(public_path($image->url));
            $result = $image->delete();
            if ($result) {
                return $this->sendResponse($result, 'Image deleted successfully.');
            } else {
                return ApiHelper::sendError('Portfolio image not deleted.');
            }
        }else{
            return ApiHelper::sendError('Portfolio not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $portfolio = Portfolio::query()->find($id);
            if ($portfolio->user_id == User::getUserId()) {
                $result = $portfolio->delete();
                if ($result) {
                    return $this->sendResponse([], 'Portfolio deleted.');
                } else {
                    return ApiHelper::sendError('Portfolio not deleted.');
                }
            } else {
                return ApiHelper::sendError('Portfolio not found.');
            }
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }
}
