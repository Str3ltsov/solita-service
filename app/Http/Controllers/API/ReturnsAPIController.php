<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReturnsAPIRequest;
use App\Http\Requests\API\UpdateReturnsAPIRequest;
use App\Models\Returns;
use App\Repositories\ReturnsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReturnsController
 * @package App\Http\Controllers\API
 */

class ReturnsAPIController extends AppBaseController
{
    /** @var  ReturnsRepository */
    private $returnsRepository;

    public function __construct(ReturnsRepository $returnsRepo)
    {
        $this->returnsRepository = $returnsRepo;
    }

    /**
     * Display a listing of the Returns.
     * GET|HEAD /returns
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $returns = $this->returnsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($returns->toArray(), 'Returns retrieved successfully');
    }

    /**
     * Store a newly created Returns in storage.
     * POST /returns
     *
     * @param CreateReturnsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReturnsAPIRequest $request)
    {
        $input = $request->all();

        $returns = $this->returnsRepository->create($input);

        return $this->sendResponse($returns->toArray(), 'Returns saved successfully');
    }

    /**
     * Display the specified Returns.
     * GET|HEAD /returns/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Returns $returns */
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            return $this->sendError('Returns not found');
        }

        return $this->sendResponse($returns->toArray(), 'Returns retrieved successfully');
    }

    /**
     * Update the specified Returns in storage.
     * PUT/PATCH /returns/{id}
     *
     * @param int $id
     * @param UpdateReturnsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReturnsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Returns $returns */
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            return $this->sendError('Returns not found');
        }

        $returns = $this->returnsRepository->update($input, $id);

        return $this->sendResponse($returns->toArray(), 'Returns updated successfully');
    }

    /**
     * Remove the specified Returns from storage.
     * DELETE /returns/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Returns $returns */
        $returns = $this->returnsRepository->find($id);

        if (empty($returns)) {
            return $this->sendError('Returns not found');
        }

        $returns->delete();

        return $this->sendSuccess('Returns deleted successfully');
    }
}
