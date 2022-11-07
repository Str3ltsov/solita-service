<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\DiscountCoupon;

class DiscountCouponApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/discount_coupons', $discountCoupon
        );

        $this->assertApiResponse($discountCoupon);
    }

    /**
     * @test
     */
    public function test_read_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/discount_coupons/'.$discountCoupon->id
        );

        $this->assertApiResponse($discountCoupon->toArray());
    }

    /**
     * @test
     */
    public function test_update_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->create();
        $editedDiscountCoupon = DiscountCoupon::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/discount_coupons/'.$discountCoupon->id,
            $editedDiscountCoupon
        );

        $this->assertApiResponse($editedDiscountCoupon);
    }

    /**
     * @test
     */
    public function test_delete_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/discount_coupons/'.$discountCoupon->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/discount_coupons/'.$discountCoupon->id
        );

        $this->response->assertStatus(404);
    }
}
