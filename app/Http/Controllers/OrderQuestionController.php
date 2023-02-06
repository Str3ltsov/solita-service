<?php

namespace App\Http\Controllers;

use App\Models\OrderQuestion;
use App\Traits\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class OrderQuestionController extends Controller
{
    use OrderServices, PrepareTranslations;

    /*
     * Main page of order questions.
     */
    public function index(): Factory|View|Application
    {
        return view('order_questions.index')
            ->with('orderQuestions', $this->getOrderQuestions());
    }

    /*
     * Create page for an order question.
     */
    public function create(): Factory|View|Application
    {
        return view('order_questions.create');
    }

    private function validateQuestions(object $request): array
    {
        return $request->validate([
            'question_en' => 'required',
            'question_lt' => 'required',
            'question_ru' => 'required'
        ]);
    }

    /*
     * Creates order question with translations.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $this->prepare($this->validateQuestions($request), ['question']);
            $data['created_at'] = now();

            OrderQuestion::create($data);

            return redirect()
                ->route('orderQuestions.index')
                ->with('success', __('messages.successCreateQuestion'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Edit page for an order question.
     */
    public function edit(int $id): Factory|View|Application
    {
        return view('order_questions.edit')
            ->with('orderQuestion', $this->getOrderQuestionById($id));
    }

    /*
     * Updates order question with translations.
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        try {
            $orderQuestion = $this->getOrderQuestionById($id);

            $data = $this->prepare($this->validateQuestions($request), ['question']);
            $data['updated_at'] = now();

            $orderQuestion->update($data);

            return redirect()
                ->route('orderQuestions.index')
                ->with('success', __('messages.successUpdateQuestion'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Deletes order question with translations.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $orderQuestion = $this->getOrderQuestionById($id);
            $orderQuestion->delete();

            return back()->with('success', __('messages.successDeleteQuestion'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
