<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRatingsAPIRequest;
use App\Http\Requests\API\UpdateRatingsAPIRequest;
use App\Models\Ratings;
use App\Repositories\RatingsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RatingsController
 * @package App\Http\Controllers\API
 */

class RatingsAPIController extends AppBaseController
{
    /** @var  RatingsRepository */
    private $ratingsRepository;

    public function __construct(RatingsRepository $ratingsRepo)
    {
        $this->ratingsRepository = $ratingsRepo;
    }

    /**
     * Display a listing of the Ratings.
     * GET|HEAD /ratings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $ratings = $this->ratingsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ratings->toArray(), 'Ratings retrieved successfully');
    }

    /**
     * Store a newly created Ratings in storage.
     * POST /ratings
     *
     * @param CreateRatingsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingsAPIRequest $request)
    {
        $input = $request->all();

        $ratings = $this->ratingsRepository->create($input);

        return $this->sendResponse($ratings->toArray(), 'Ratings saved successfully');
    }

    /**
     * Display the specified Ratings.
     * GET|HEAD /ratings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Ratings $ratings */
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            return $this->sendError('Ratings not found');
        }

        return $this->sendResponse($ratings->toArray(), 'Ratings retrieved successfully');
    }

    /**
     * Update the specified Ratings in storage.
     * PUT/PATCH /ratings/{id}
     *
     * @param int $id
     * @param UpdateRatingsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ratings $ratings */
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            return $this->sendError('Ratings not found');
        }

        $ratings = $this->ratingsRepository->update($input, $id);

        return $this->sendResponse($ratings->toArray(), 'Ratings updated successfully');
    }

    /**
     * Remove the specified Ratings from storage.
     * DELETE /ratings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Ratings $ratings */
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            return $this->sendError('Ratings not found');
        }

        $ratings->delete();

        return $this->sendSuccess('Ratings deleted successfully');
    }
}
