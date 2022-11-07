<?php namespace Tests\Repositories;

use App\Models\CartItem;
use App\Repositories\CartItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CartItemRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CartItemRepository
     */
    protected $cartItemRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cartItemRepo = \App::make(CartItemRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cart_item()
    {
        $cartItem = CartItem::factory()->make()->toArray();

        $createdCartItem = $this->cartItemRepo->create($cartItem);

        $createdCartItem = $createdCartItem->toArray();
        $this->assertArrayHasKey('id', $createdCartItem);
        $this->assertNotNull($createdCartItem['id'], 'Created CartItem must have id specified');
        $this->assertNotNull(CartItem::find($createdCartItem['id']), 'CartItem with given id must be in DB');
        $this->assertModelData($cartItem, $createdCartItem);
    }

    /**
     * @test read
     */
    public function test_read_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $dbCartItem = $this->cartItemRepo->find($cartItem->id);

        $dbCartItem = $dbCartItem->toArray();
        $this->assertModelData($cartItem->toArray(), $dbCartItem);
    }

    /**
     * @test update
     */
    public function test_update_cart_item()
    {
        $cartItem = CartItem::factory()->create();
        $fakeCartItem = CartItem::factory()->make()->toArray();

        $updatedCartItem = $this->cartItemRepo->update($fakeCartItem, $cartItem->id);

        $this->assertModelData($fakeCartItem, $updatedCartItem->toArray());
        $dbCartItem = $this->cartItemRepo->find($cartItem->id);
        $this->assertModelData($fakeCartItem, $dbCartItem->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $resp = $this->cartItemRepo->delete($cartItem->id);

        $this->assertTrue($resp);
        $this->assertNull(CartItem::find($cartItem->id), 'CartItem should not exist in DB');
    }
}
