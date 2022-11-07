<?php namespace Tests\Repositories;

use App\Models\DiscountCoupon;
use App\Repositories\DiscountCouponRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DiscountCouponRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DiscountCouponRepository
     */
    protected $discountCouponRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->discountCouponRepo = \App::make(DiscountCouponRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->make()->toArray();

        $createdDiscountCoupon = $this->discountCouponRepo->create($discountCoupon);

        $createdDiscountCoupon = $createdDiscountCoupon->toArray();
        $this->assertArrayHasKey('id', $createdDiscountCoupon);
        $this->assertNotNull($createdDiscountCoupon['id'], 'Created DiscountCoupon must have id specified');
        $this->assertNotNull(DiscountCoupon::find($createdDiscountCoupon['id']), 'DiscountCoupon with given id must be in DB');
        $this->assertModelData($discountCoupon, $createdDiscountCoupon);
    }

    /**
     * @test read
     */
    public function test_read_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->create();

        $dbDiscountCoupon = $this->discountCouponRepo->find($discountCoupon->id);

        $dbDiscountCoupon = $dbDiscountCoupon->toArray();
        $this->assertModelData($discountCoupon->toArray(), $dbDiscountCoupon);
    }

    /**
     * @test update
     */
    public function test_update_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->create();
        $fakeDiscountCoupon = DiscountCoupon::factory()->make()->toArray();

        $updatedDiscountCoupon = $this->discountCouponRepo->update($fakeDiscountCoupon, $discountCoupon->id);

        $this->assertModelData($fakeDiscountCoupon, $updatedDiscountCoupon->toArray());
        $dbDiscountCoupon = $this->discountCouponRepo->find($discountCoupon->id);
        $this->assertModelData($fakeDiscountCoupon, $dbDiscountCoupon->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_discount_coupon()
    {
        $discountCoupon = DiscountCoupon::factory()->create();

        $resp = $this->discountCouponRepo->delete($discountCoupon->id);

        $this->assertTrue($resp);
        $this->assertNull(DiscountCoupon::find($discountCoupon->id), 'DiscountCoupon should not exist in DB');
    }
}
