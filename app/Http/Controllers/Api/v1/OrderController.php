<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ApiHelper;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function index(int $id): JsonResponse
    {
        try {
            $order = Order::query()->whereStudentId($id);
            return $this->sendResponse(OrderResource::collection($order));
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $orderList = Order::whereStudentId(User::getUserId());
            if ($orderList != null) {
                $order              = new Order();
                $order->date        = Carbon::now()
                    ->timezone('Europe/Moscow')
                    ->format('d F h:i');
                $order->is_check    = false;
                $order->student_id  = User::getUserId();
                $order->company_id  = $request->company_id;
                $order->practice_id = $request->practice_id;
                $result             = $order->save();
                if ($result != null) {
                    return $this->sendResponse(new OrderResource($order), 'Order created.');
                }
                return ApiHelper::sendError('Order not created.');
            }
            return ApiHelper::sendError('You already create order.');
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $order = Order::findOrFail($id);

        }
        catch (\Exception $e){
            return ApiHelper::sendError($e);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $order = Order::find($id);
            if ($order->student_id == User::getUserId()) {
                $result = $order->delete();
                if ($result) {
                    return $this->sendResponse($result, 'Order deleted.');
                }
                return ApiHelper::sendError('Order not found.');
            }
            return ApiHelper::sendError('Order not found.');
        } catch (\Exception $e) {
            return ApiHelper::sendError($e);
        }
    }
}
