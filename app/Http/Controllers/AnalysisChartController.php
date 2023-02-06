<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Returns;
use App\Models\User;
use App\Traits\UserReviewServices;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AnalysisChartController extends Controller
{
    use UserReviewServices, forSelector;

    private array $orderStatuses;
//    private array $returnStatuses;

    public function __construct()
    {
        $this->orderStatuses = $this->orderStatusesForSelector();
//        $this->returnStatuses = $this->returnStatusesForSelector();

        $this->orderStatuses[] = __('All');
//        $this->returnStatuses[] = __('All');
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = $this->getUsers(2);

        return view('analysis_chart.index')
            ->with([
                'roles' => [
                    2 => __('table.specialist'),
                    3 => __('table.employee')
                ],
                'dataTypes' => [
                    1 => __('names.ratingOrRatings'),
                    2 => __('menu.orders'),
//                    3 => __('menu.returns'),
//                    4 => __('names.orderReturnCoefficient')
                ],
                'chartTypes' => [
                    1 => __('names.pie'),
                    2 => __('names.bar'),
                    3 => __('names.line')
                ],
                'orderStatuses' => $this->orderStatuses,
//                'returnStatuses' => $this->returnStatuses,
                'initialChart' => [
                    'data' => $this->getRatings($users),
                    'labels' => $this->getLabels($users),
                    'type' => $this->getChartTypes(1),
                    'label' => $this->getLabel(1)
                ]
            ]);
    }

    private function getUsers(int $role)
    {
        $users = User::select('id', 'name', 'type')->where('type', $role)->get();

        if (empty($users))
            throw new Exception(__('messages.errorEmptyUsers'));
        else
            return $users;
    }

    private function getRatings(object $users): array
    {
        $data = [];

        foreach ($users as $user) {
            $data[] = round($this->getReviewRatingAverage($user), 1);
        }

        if (empty($data))
            throw new Exception(__('messages.errorEmptyData'));
        else
            return $data;
    }

    private function getOrdersByUserId(int $role, int $userId, int|null $status): Collection
    {
        $orders = null;

        $role === 2 && $orders = Order::join('order_users', function($join) {
                $join->on('orders.id', '=', 'order_users.order_id');
            })
            ->where('order_users.user_id', '=', $userId);
        $role === 3 && $orders = Order::select('id')->where('employee_id', $userId);

        if ($status !== array_key_last($this->orderStatuses)) {
            return $orders->where('status_id', $status)->get();
        }

        return $orders->get();
    }

    /**
     * @throws Exception
     */
    private function getOrderCounts(object $users, int|null $status): array
    {
        $data = [];

        foreach ($users as $user) {
            $data[] = count($this->getOrdersByUserId($user->type, $user->id, $status));
        }

        if (empty($data))
            throw new Exception(__('messages.errorEmptyData'));
        else
            return $data;
    }

//    private function getReturnsByUserId(int $role, int $userId, int|null $status): Collection|array
//    {
//        $returns = null;
//
//        $role === 2 && $returns = Returns::select('id')->where('specialist_id', $userId);
//        $role === 3 && $returns = Returns::select('id')->where('employee_id', $userId);
//
//        if ($status !== array_key_last($this->returnStatuses)) {
//            return $returns->where('status_id', $status)->get();
//        }
//
//        return $returns->get();
//    }
//
//    /**
//     * @throws Exception
//     */
//    private function getReturnCounts(object $users, int|null $status): array
//    {
//        $data = [];
//
//        foreach ($users as $user) {
//            $data[] = count($this->getReturnsByUserId($user->type, $user->id, $status));
//        }
//
//        if (empty($data))
//            throw new Exception(__('messages.errorEmptyData'));
//        else
//            return $data;
//    }

//    private function getCoefficient(int $userType, int $userId): float
//    {
//        $returns = $this->getReturnsByUserId($userType, $userId, array_key_last($this->returnStatuses));
//        $orders = $this->getOrdersByUserId($userType, $userId, array_key_last($this->orderStatuses));
//
//        $returnCount = count($returns);
//        $orderCount = count($orders);
//
//        $coefficient = ($returnCount / $orderCount) * 100;
//
//        return round($coefficient, 2);
//    }

    /**
     * @throws Exception
     */
//    private function getOrderReturnCoefficients(object $users)
//    {
//        $data = [];
//
//        foreach ($users as $user) {
//            $data[] = $this->getCoefficient($user->type, $user->id);
//        }
//
//        if (empty($data))
//            throw new Exception(__('messages.errorEmptyData'));
//        else
//            return $data;
//    }

    /**
     * @throws Exception
     */
    private function getLabels(object $users): array
    {
        $labels = [];

        foreach ($users as $user) {
            $labels[] = $user->name;
        }

        if (empty($labels))
            throw new Exception(__('messages.errorEmptyLabels'));
        else
            return $labels;
    }

    private function getChartTypes(int $chartType): string
    {
        if ($chartType === 1)
            return 'pie';
        if ($chartType === 2)
            return 'bar';
        if ($chartType === 3)
            return 'line';

        return 'pie';
    }

    private function getLabel(int $dataType): ?string
    {
        if ($dataType === 1)
            return __('names.ratingOrRatings');
        if ($dataType === 2)
            return __('menu.orders');
//        if ($dataType === 3)
//            return __('menu.returns');
//        if ($dataType === 4)
//            return __('names.orderReturnCoefficient');

        return null;
    }

    public function getAnalysisChartData(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $users = $this->getUsers($request->role);
            $dataType = (int)$request->dataType;
            $data = [];

            $dataType === 1 && $data = $this->getRatings($users);
            $dataType === 2 && $data = $this->getOrderCounts($users, $request->orderStatus);
//            $dataType === 3 && $data = $this->getReturnCounts($users, $request->returnStatus);
//            $dataType === 4 && $data = $this->getOrderReturnCoefficients($users);

            return response()->json([
                'data' => $data,
                'labels' => $this->getLabels($users),
                'type' => $this->getChartTypes($request->chartType),
                'label' => $this->getLabel($dataType)
            ]);
        }
        catch (\Throwable $exc) {
            return response()->json(['message' => $exc->getMessage()]);
        }
    }
}
