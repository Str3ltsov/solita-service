<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\forSelector;
use App\Http\Requests\UpdateReturnRequest;
use App\Traits\OrderServices;
use App\Traits\ReturnServices;
use App\Traits\UserReviewServices;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    use OrderServices, ReturnServices, UserReviewServices, forSelector;

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('employee_views.returns.index')
            ->with('returns', $this->getReturns(auth()->user()->type));
    }

    public function show(int $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $return = $this->getReturnById($id);
        $returnItems = $this->getReturnItems($id);

        $this->setReturnItemPriceSum($returnItems);
        $this->setReturnItemCountSum($returnItems);

        return view('employee_views.returns.show')
            ->with([
                'return' => $return,
                'reviewAverageRating' => [
                    'user' => $this->getReviewRatingAverage($return->user),
                    'specialist' => $this->getReviewRatingAverage($return->specialist),
                ],
                'returnItems' => $this->getReturnItems($id),
                'statusList' => $this->returnStatusesForSelector(),
                'specialistList' => $this->orderSpecialistForSelector(),
                'logs' => $this->getOrderLogs($return->order_id)->sortDesc(),
                'returnItemPriceSum' => $this->getReturnItemPriceSum(),
                'returnItemCountSum' => $this->getReturnItemCountSum()
            ]);
    }

    public function update(int $id, UpdateReturnRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        try {
            $return = $this->getReturnById($id);

            $this->setUpdateReturnLogs($return, $request);

            $return->specialist_id = $validated['specialist_id'];
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
