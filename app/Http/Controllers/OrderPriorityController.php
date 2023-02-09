<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderPriorityRequest;
use App\Http\Requests\UpdateOrderPriorityRequest;
use App\Models\OrderPriority;
use App\Models\OrderQuestion;
use App\Traits\OrderServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderPriorityController extends Controller
{
    use OrderServices;
    /*
     * Main page of order priorities.
     */
    public function index(): Factory|View|Application
    {
        return view('order_priorities.index')
            ->with('orderPriorities', $this->getOrderPriorities());
    }

    /*
     * Create page for an order priority.
     */
    public function create(): Factory|View|Application
    {
        return view('order_priorities.create');
    }

    /*
     * Creates order priority.
     */
    public function store(CreateOrderPriorityRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            OrderPriority::firstOrCreate([
                'name' => $validated['name'],
                'created_at' => now()
            ]);

            return redirect()
                ->route('orderPriorities.index')
                ->with('success', __('messages.successCreatePriority'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Edit page for an order priority.
     */
    public function edit(int $id): Factory|View|Application
    {
        return view('order_priorities.edit')
            ->with('orderPriority', $this->getOrderPriorityById($id));
    }

    /*
     * Updates order priority.
     */
    public function update(int $id, UpdateOrderPriorityRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $orderPriority = $this->getOrderPriorityById($id);
            $orderPriority->name = $validated['name'];
            $orderPriority->updated_at = now();
            $orderPriority->save();

            return redirect()
                ->route('orderPriorities.index')
                ->with('success', __('messages.successUpdatePriority'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Deletes order priority.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $orderPriority = $this->getOrderPriorityById($id);
            $orderPriority->delete();

            return back()->with('success', __('messages.successDeletePriority'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
