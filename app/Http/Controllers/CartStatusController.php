<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCartStatusRequest;
use App\Http\Requests\UpdateCartStatusRequest;
use App\Repositories\CartStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CartStatusController extends AppBaseController
{
    /** @var CartStatusRepository $cartStatusRepository*/
    private $cartStatusRepository;

    public function __construct(CartStatusRepository $cartStatusRepo)
    {
        $this->cartStatusRepository = $cartStatusRepo;
    }

    /**
     * Display a listing of the CartStatus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cartStatuses = $this->cartStatusRepository->all();

        return view('cart_statuses.index')
            ->with('cartStatuses', $cartStatuses);
    }

    /**
     * Show the form for creating a new CartStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('cart_statuses.create');
    }

    /**
     * Store a newly created CartStatus in storage.
     *
     * @param CreateCartStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateCartStatusRequest $request)
    {
        $input = $request->all();

        $cartStatus = $this->cartStatusRepository->create($input);

        Flash::success('Cart Status saved successfully.');

        return redirect(route('cartStatuses.index'));
    }

    /**
     * Display the specified CartStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            Flash::error('Cart Status not found');

            return redirect(route('cartStatuses.index'));
        }

        return view('cart_statuses.show')->with('cartStatus', $cartStatus);
    }

    /**
     * Show the form for editing the specified CartStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            Flash::error('Cart Status not found');

            return redirect(route('cartStatuses.index'));
        }

        return view('cart_statuses.edit')->with('cartStatus', $cartStatus);
    }

    /**
     * Update the specified CartStatus in storage.
     *
     * @param int $id
     * @param UpdateCartStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartStatusRequest $request)
    {
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            Flash::error('Cart Status not found');

            return redirect(route('cartStatuses.index'));
        }

        $cartStatus = $this->cartStatusRepository->update($request->all(), $id);

        Flash::success('Cart Status updated successfully.');

        return redirect(route('cartStatuses.index'));
    }

    /**
     * Remove the specified CartStatus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cartStatus = $this->cartStatusRepository->find($id);

        if (empty($cartStatus)) {
            Flash::error('Cart Status not found');

            return redirect(route('cartStatuses.index'));
        }

        $this->cartStatusRepository->delete($id);

        Flash::success('Cart Status deleted successfully.');

        return redirect(route('cartStatuses.index'));
    }
}
