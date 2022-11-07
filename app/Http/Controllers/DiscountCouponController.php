<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiscountCouponRequest;
use App\Http\Requests\UpdateDiscountCouponRequest;
use App\Repositories\DiscountCouponRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class DiscountCouponController extends AppBaseController
{
    /** @var DiscountCouponRepository $discountCouponRepository*/
    private $discountCouponRepository;
    private $used_list = ["0","1"];
    use forSelector;

    public function __construct(DiscountCouponRepository $discountCouponRepo)
    {
        $this->discountCouponRepository = $discountCouponRepo;
    }

    /**
     * Display a listing of the DiscountCoupon.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $discountCoupons = $this->discountCouponRepository->all();

        return view('discount_coupons.index')
            ->with('discountCoupons', $discountCoupons);
    }


    public function discountcouponUser(Request $request)
    {
        $discountCoupons = $this->discountCouponRepository->all()->where('user_id', Auth::user()->id);

        if (!empty($discountCoupons->count())) {
            $discountCoupons = $discountCoupons->toQuery()->paginate(4);
        }

        return view('user_views.discount_coupons.index')
            ->with('discountCoupons', $discountCoupons);
    }
    /**
     * Show the form for creating a new DiscountCoupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('discount_coupons.create', ['used_list'=>$this->used_list, "users_list" => $this->usersForSelector()]);
    }

    /**
     * Store a newly created DiscountCoupon in storage.
     *
     * @param CreateDiscountCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateDiscountCouponRequest $request)
    {
        $input = $request->all();

        $discountCoupon = $this->discountCouponRepository->create($input);

        Flash::success('Discount Coupon saved successfully.');

        return redirect(route('discountCoupons.index'));
    }

    /**
     * Display the specified DiscountCoupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            Flash::error('Discount Coupon not found');

            return redirect(route('discountCoupons.index'));
        }

        return view('discount_coupons.show')->with('discountCoupon', $discountCoupon);
    }

    /**
     * Show the form for editing the specified DiscountCoupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            Flash::error('Discount Coupon not found');

            return redirect(route('discountCoupons.index'));
        }

        return view('discount_coupons.edit')->with(['discountCoupon' => $discountCoupon,
            'used_list'=>$this->used_list, "users_list" => $this->usersForSelector()]);
    }

    /**
     * Update the specified DiscountCoupon in storage.
     *
     * @param int $id
     * @param UpdateDiscountCouponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDiscountCouponRequest $request)
    {
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            Flash::error('Discount Coupon not found');

            return redirect(route('discountCoupons.index'));
        }

        $discountCoupon = $this->discountCouponRepository->update($request->all(), $id);

        Flash::success('Discount Coupon updated successfully.');

        return redirect(route('discountCoupons.index'));
    }

    /**
     * Remove the specified DiscountCoupon from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $discountCoupon = $this->discountCouponRepository->find($id);

        if (empty($discountCoupon)) {
            Flash::error('Discount Coupon not found');

            return redirect(route('discountCoupons.index'));
        }

        $this->discountCouponRepository->delete($id);

        Flash::success('Discount Coupon deleted successfully.');

        return redirect(route('discountCoupons.index'));
    }
}
