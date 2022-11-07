<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CartItem;

class CartItemApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cart_item()
    {
        $cartItem = CartItem::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cart_items', $cartItem
        );

        $this->assertApiResponse($cartItem);
    }

    /**
     * @test
     */
    public function test_read_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cart_items/'.$cartItem->id
        );

        $this->assertApiResponse($cartItem->toArray());
    }

    /**
     * @test
     */
    public function test_update_cart_item()
    {
        $cartItem = CartItem::factory()->create();
        $editedCartItem = CartItem::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cart_items/'.$cartItem->id,
            $editedCartItem
        );

        $this->assertApiResponse($editedCartItem);
    }

    /**
     * @test
     */
    public function test_delete_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cart_items/'.$cartItem->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cart_items/'.$cartItem->id
        );

        $this->response->assertStatus(404);
    }
}
