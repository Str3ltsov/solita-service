<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Controllers\forSelector;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\UpdateReturnRequest;
use App\Traits\OrderServices;
use App\Traits\ReturnServices;
use App\Traits\UserReviewServices;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    use OrderServices, ReturnServices, UserReviewServices, forSelector;

    public function __construct()
    {
        //
    }

    /**
     * Displays a list of returns
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('specialist_views.returns.index')
            ->with('returns', $this->getReturns(auth()->user()->type));
    }

    /**
     * Display return details
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $return = $this->getReturnById($id);
        $returnItems = $this->getReturnItems($id);

        $this->setReturnItemPriceSum($returnItems);
        $this->setReturnItemCountSum($returnItems);

        return view('specialist_views.returns.show')
            ->with([
                'return' => $return,
                'reviewAverageRating' => [
                    'user' => $this->getReviewRatingAverage($return->user),
                    'employee' => $this->getReviewRatingAverage($return->employee),
                ],
                'returnItems' => $this->getReturnItems($id),
                'statusList' => $this->returnStatusesForSelector(),
                'logs' => $this->getOrderLogs($return->order_id)->sortDesc(),
                'returnItemPriceSum' => $this->getReturnItemPriceSum(),
                'returnItemCountSum' => $this->getReturnItemCountSum()
            ]);
    }

    /**
     * Update the specified return
     *
     * @param int $id
     * @param UpdateReturnRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateReturnRequest $request)
    {
        $validated = $request->validated();

        try {
            $return = $this->getReturnById($id);

            $this->setUpdateReturnLogs($return, $request);

            $return->status_id = $validated['status_id'];
            $return->updated_at = now();
            $return->save();

            return back()->with('success', __('messages.successUpdateReturn'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception);
        }
    }
}
