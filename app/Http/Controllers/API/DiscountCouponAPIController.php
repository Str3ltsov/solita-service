<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDiscountCouponAPIRequest;
use App\Http\Requests\API\UpdateDiscountCouponAPIRequest;
use App\Models\DiscountCoupon;
use App\Repositories\DiscountCouponRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DiscountCouponController
 * @package App\Http\Controllers\API
 */

class DiscountCouponAPIController extends AppBaseController
{
    /** @var  DiscountCouponRepository */
    private $discountCouponRepository;

    public function __construct(DiscountCouponRepository $discountCouponRepo)
    {
        $this->discountCouponRepository = $discountCouponRepo;
    }

    /**
     * Display a listing of the DiscountCoupon.
     * GET|HEAD /discountCoupons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $discountCoupons = $this->discountCouponRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($discountCoupons->toArray(), 'Discount Coupons retrieved successfully');
    }

    /**
     * Store a newly created DiscountCoupon in storage.
     * POST /discountCoupons
     *
     * @param CreateDiscountCouponAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDiscountCouponAPIRequest $request)
    {
        $input = $request->all();

        $discountCoupon = $this->discountCouponRepository->create($input);

        return $this->sendResponse($discountCoupon->toArray(), 'Discount Coupon saved successfully');
    }

    /**
     * Display the specified DiscountCoupon.
     * GET|HEAD /discountCoupons/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DiscountCoupon $discountCoupon */
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            return $this->sendError('Discount Coupon not found');
        }

        return $this->sendResponse($discountCoupon->toArray(), 'Discount Coupon retrieved successfully');
    }

    /**
     * Update the specified DiscountCoupon in storage.
     * PUT/PATCH /discountCoupons/{id}
     *
     * @param int $id
     * @param UpdateDiscountCouponAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDiscountCouponAPIRequest $request)
    {
        $input = $request->all();

        /** @var DiscountCoupon $discountCoupon */
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            return $this->sendError('Discount Coupon not found');
        }

        $discountCoupon = $this->discountCouponRepository->update($input, $id);

        return $this->sendResponse($discountCoupon->toArray(), 'DiscountCoupon updated successfully');
    }

    /**
     * Remove the specified DiscountCoupon from storage.
     * DELETE /discountCoupons/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DiscountCoupon $discountCoupon */
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            return $this->sendError('Discount Coupon not found');
        }

        $discountCoupon->delete();

        return $this->sendSuccess('Discount Coupon deleted successfully');
    }
}
