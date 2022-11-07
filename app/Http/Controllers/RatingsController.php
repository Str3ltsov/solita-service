<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRatingsRequest;
use App\Http\Requests\UpdateRatingsRequest;
use App\Models\Ratings;
use App\Repositories\RatingsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class RatingsController extends AppBaseController
{
    /** @var RatingsRepository $ratingsRepository*/
    private $ratingsRepository;

    public function __construct(RatingsRepository $ratingsRepo)
    {
        $this->ratingsRepository = $ratingsRepo;
    }

    /**
     * Display a listing of the Ratings.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ratings = $this->ratingsRepository->all();

        return view('ratings.index')
            ->with('ratings', $ratings);
    }

    /**
     * Show the form for creating a new Ratings.
     *
     * @return Response
     */
    public function create()
    {
        return view('ratings.create');
    }

    /**
     * Store a newly created Ratings in storage.
     *
     * @param CreateRatingsRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingsRequest $request)
    {
        $input = $request->all();

        $ratings = $this->ratingsRepository->create($input);

        Flash::success('Ratings saved successfully.');

        return redirect(route('ratings.index'));
    }

    /**
     * Display the specified Ratings.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            Flash::error('Ratings not found');

            return redirect(route('ratings.index'));
        }

        return view('ratings.show')->with('ratings', $ratings);
    }

    /**
     * Show the form for editing the specified Ratings.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            Flash::error('Ratings not found');

            return redirect(route('ratings.index'));
        }

        return view('ratings.edit')->with('ratings', $ratings);
    }

    /**
     * Update the specified Ratings in storage.
     *
     * @param int $id
     * @param UpdateRatingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingsRequest $request)
    {
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            Flash::error('Ratings not found');

            return redirect(route('ratings.index'));
        }

        $ratings = $this->ratingsRepository->update($request->all(), $id);

        Flash::success('Ratings updated successfully.');

        return redirect(route('ratings.index'));
    }

    /**
     * Remove the specified Ratings from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ratings = $this->ratingsRepository->find($id);

        if (empty($ratings)) {
            Flash::error('Ratings not found');

            return redirect(route('ratings.index'));
        }

        $this->ratingsRepository->delete($id);

        Flash::success('Ratings deleted successfully.');

        return redirect(route('ratings.index'));
    }

    public function addUserRating(Request $request)
    {
        $username = Auth::user()->id;
        $response = "";
        if ( $username != null ) {
            $rating = new Ratings();
            $rating->user_id = $username;
            $rating->value = $request->rating;
            $rating->product_id = $request->product;
            $rating->description = $request->description;
            $rating->save();
            $response = "ok";
        }
        return response()->json(array("val"=>$response), 200);
    }
}
