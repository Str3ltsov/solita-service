<?php namespace Tests\Repositories;

use App\Models\CartStatus;
use App\Repositories\CartStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CartStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CartStatusRepository
     */
    protected $cartStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cartStatusRepo = \App::make(CartStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cart_status()
    {
        $cartStatus = CartStatus::factory()->make()->toArray();

        $createdCartStatus = $this->cartStatusRepo->create($cartStatus);

        $createdCartStatus = $createdCartStatus->toArray();
        $this->assertArrayHasKey('id', $createdCartStatus);
        $this->assertNotNull($createdCartStatus['id'], 'Created CartStatus must have id specified');
        $this->assertNotNull(CartStatus::find($createdCartStatus['id']), 'CartStatus with given id must be in DB');
        $this->assertModelData($cartStatus, $createdCartStatus);
    }

    /**
     * @test read
     */
    public function test_read_cart_status()
    {
        $cartStatus = CartStatus::factory()->create();

        $dbCartStatus = $this->cartStatusRepo->find($cartStatus->id);

        $dbCartStatus = $dbCartStatus->toArray();
        $this->assertModelData($cartStatus->toArray(), $dbCartStatus);
    }

    /**
     * @test update
     */
    public function test_update_cart_status()
    {
        $cartStatus = CartStatus::factory()->create();
        $fakeCartStatus = CartStatus::factory()->make()->toArray();

        $updatedCartStatus = $this->cartStatusRepo->update($fakeCartStatus, $cartStatus->id);

        $this->assertModelData($fakeCartStatus, $updatedCartStatus->toArray());
        $dbCartStatus = $this->cartStatusRepo->find($cartStatus->id);
        $this->assertModelData($fakeCartStatus, $dbCartStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cart_status()
    {
        $cartStatus = CartStatus::factory()->create();

        $resp = $this->cartStatusRepo->delete($cartStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(CartStatus::find($cartStatus->id), 'CartStatus should not exist in DB');
    }
}
