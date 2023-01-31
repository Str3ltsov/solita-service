<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderAnswersRequest;
use App\Models\OrderAnswer;
use App\Traits\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

class OrderReviewController extends Controller
{
    use OrderServices;

    private object $orderQuestions;

    public function __construct()
    {
        $this->orderQuestions = $this->getOrderQuestions();
    }

    /*
     * Gets order review page.
     */
    public function getOrderReview($prefix, int $id): Factory|View|Application|RedirectResponse
    {
        $order = $this->getOrderById($id);

        if (count($order->questionAnswers) > 0)
            return back()->with('error', __('messages.errorUnauthAccess'));

        return view('user_views.order_review.index')
            ->with([
                'order' => $this->getOrderById($id),
                'orderQuestions' => $this->orderQuestions
            ]);
    }

    private function createOrderAnswers(array $validated): void
    {
        foreach ($this->orderQuestions as $key => $question) {
            OrderAnswer::firstOrCreate([
                'user_id' => $validated['user_id'],
                'order_id' => $validated['order_id'],
                'order_question_id' => $validated['question'][$key]['id'],
                'answer' => $validated['question'][$key]['answer'],
                'created_at' => now()
            ]);
        }
    }

    /*
     * Posts order answers for order questions.
     */
    public function postOrderReview($prefix, int $id, CreateOrderAnswersRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $this->createOrderAnswers($validated);

            return redirect()
                ->route('vieworder', [$prefix, $id])
                ->with('success', __('messages.successOrderReviewed'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
