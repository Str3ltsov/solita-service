<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReturnStatusRequest;
use App\Http\Requests\UpdateReturnStatusRequest;
use App\Repositories\ReturnStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ReturnStatusController extends AppBaseController
{
    /** @var ReturnStatusRepository $returnStatusRepository*/
    private $returnStatusRepository;

    public function __construct(ReturnStatusRepository $returnStatusRepo)
    {
        $this->returnStatusRepository = $returnStatusRepo;
    }

    /**
     * Display a listing of the ReturnStatus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $returnStatuses = $this->returnStatusRepository->all();

        return view('return_statuses.index')
            ->with('returnStatuses', $returnStatuses);
    }

    /**
     * Show the form for creating a new ReturnStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('return_statuses.create');
    }

    /**
     * Store a newly created ReturnStatus in storage.
     *
     * @param CreateReturnStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnStatusRequest $request)
    {
        $input = $request->all();

        $returnStatus = $this->returnStatusRepository->create($input);

        Flash::success('Return Status saved successfully.');

        return redirect(route('returnStatuses.index'));
    }

    /**
     * Display the specified ReturnStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            Flash::error('Return Status not found');

            return redirect(route('returnStatuses.index'));
        }

        return view('return_statuses.show')->with('returnStatus', $returnStatus);
    }

    /**
     * Show the form for editing the specified ReturnStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            Flash::error('Return Status not found');

            return redirect(route('returnStatuses.index'));
        }

        return view('return_statuses.edit')->with('returnStatus', $returnStatus);
    }

    /**
     * Update the specified ReturnStatus in storage.
     *
     * @param int $id
     * @param UpdateReturnStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnStatusRequest $request)
    {
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            Flash::error('Return Status not found');

            return redirect(route('returnStatuses.index'));
        }

        $returnStatus = $this->returnStatusRepository->update($request->all(), $id);

        Flash::success('Return Status updated successfully.');

        return redirect(route('returnStatuses.index'));
    }

    /**
     * Remove the specified ReturnStatus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $returnStatus = $this->returnStatusRepository->find($id);

        if (empty($returnStatus)) {
            Flash::error('Return Status not found');

            return redirect(route('returnStatuses.index'));
        }

        $this->returnStatusRepository->delete($id);

        Flash::success('Return Status deleted successfully.');

        return redirect(route('returnStatuses.index'));
    }
}
