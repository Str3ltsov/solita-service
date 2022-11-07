<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductTranslation;
use App\Models\Returns;
use App\Models\User;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Carbon;
use Response;
use Illuminate\Support\Facades\Lang;

class ChartController extends AppBaseController
{

    private $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    private $noData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $this->getUserAdmin('Admin and User Count', 'pie');

        return view('customers.statistics')->with(['data' => $data]);
    }

    /**
     * Return statistic type based on selection
     *
     * @param Request $request
     * @return mixed
     */
    public function changeStatisticType(Request $request)
    {
        switch ($request->statisticType) {
            case "registerPerMonth":
                $data = $this->getUserActivity(__('names.registrations'), 'Registered', 'line');
                break;
            case "loginPerMonth":
                $data = $this->getUserActivity(__('names.logins'), 'Logged in', 'line');
                break;
            case "userAdminCount":
                $data = $this->getUserAdmin(__('names.adminUserCount'), 'pie');
                break;
            case "paidOrders":
                $data = $this->getOrderActivity('Paid', 'line');
                break;
            case "unpaidOrders":
                $data = $this->getOrderActivity('Unpaid', 'line');
                break;
            case "cancelledOrders":
                $data = $this->getOrderActivity('Cancelled', 'line');
                break;
            case "returns":
                $data = $this->getReturns(__('names.returns'), 'line');
                break;
            case "productOrders":
                $data = $this->getProductOrders(__('names.productOrderCount'), 'bar');
                break;
            default:
                break;
        }

        return Response::json(['data' => $data]);
    }

    /**
     * Returns user activity by month, chartLabel is used in ex: Number of User 'chartLabel' Per Month.
     * activityType is a type for database query in log_activities -> activity. barType ex: line,bar,pie.
     *
     * @param string $chartLabel
     * @param string $activityType
     * @param string $barType
     * @return array
     */
    public function getUserActivity(string $chartLabel, string $activityType, string $barType): array
    {

        $logs = LogActivity::select('id', 'created_at')->where('activity', $activityType)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        })->toArray();

        if (!empty($logs)) $userArr = $this->instancesPerMonth($logs);
        else $userArr = $this->noData;

        $label =  $chartLabel . ' ' . __('names.perMonth') ;

        return [array_values(($userArr)), $this->months, $barType, $label];
    }

    /**
     * Get Orders by Activity Paid,Unpaid,Cancelled by created_date
     * Return Array consists of [data,lineLabels,barType,chartLabel]
     *
     * @param string $activityType
     * @param string $barType
     * @return array
     */
    public function getOrderActivity(string $activityType, string $barType): array
    {
        if ($activityType == 'Paid') {
            $activityType = __('names.paid');
            $queryType = [2, 3, 4];
        } elseif ($activityType == 'Unpaid') {
            $activityType = __('names.unpaid');
            $queryType = [1];
        } else {
            $activityType = __('names.canceled');
            $queryType = [5];
        }

        $orders = Order::select('id', 'created_at')->whereIn('status_id', $queryType)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        })->toArray();

        if (!empty($orders)) $ordersArr = $this->instancesPerMonth($orders);
        else $ordersArr = $this->noData;

        $label = $activityType . ' '.  __('names.ordersPerMonth');
        return [array_values(($ordersArr)), $this->months, $barType, $label];
    }

    /**
     * Get Users and Admins from database to Chart
     * Return Array consists of [data,lineLabels,barType,chartLabel]
     *
     * @param string $chartLabel
     * @param $barType
     * @return array
     */
    public function getUserAdmin(string $chartLabel, $barType): array
    {
        $users = User::where('type', 2)->count();
        $admins = User::where('type', 1)->count();


        $data = [$admins, $users];

        $lineLabels = [__('names.admins'), __('names.users')];

        return [array_values(($data)), $lineLabels, $barType, $chartLabel];
    }

    public function getReturns(string $chartLabel, $barType): array
    {
        $returns = Returns::select('id', 'created_at')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        })->toArray();


        if (!empty($returns)) $returnsArr = $this->instancesPerMonth($returns);
        else $returnsArr = $this->noData;

        $label = $chartLabel .' '. __('names.perMonth');
        return [array_values(($returnsArr)), $this->months, $barType, $label];
    }

    public function getProductOrders(string $chartLabel, $barType): array
    {
        // Get ids where status Completed
        $orders = Order::select('id')->whereIn('status_id', [6])->get();

        $orderIds = [];
        foreach ($orders as $key => $value) {
            $orderIds[(int)$key] = $value->id;
        }

        $orderItems = OrderItem::select('product_id')->whereIn('order_id', $orderIds)->get();

        $productArr = [];
        foreach ($orderItems as $key => $value) {
            $productArr[(int)$key] = ProductTranslation::where([['product_id', '=', [$value->product_id]], ['locale', '=', Lang::getLocale()]])->first()->name;
        }

        $countedArr =  array_unique($productArr);
        $countArr = [];
        foreach (array_count_values($productArr) as $value){
            $countArr[] = $value;
        }

        return [$countArr,array_values($countedArr), $barType, $chartLabel];
    }

    public function instancesPerMonth(array $data)
    {
        $monthCount = [];
        $finalArr = [];

        foreach ($data as $key => $value) {
            $monthCount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($monthCount[$i])) {
                $finalArr[$i] = $monthCount[$i];
            } else {
                $finalArr[$i] = 0;
            }
        }
        return $finalArr;
    }
}
