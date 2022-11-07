<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CartStatus;

class CartStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cart_status()
    {
        $cartStatus = CartStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cart_statuses', $cartStatus
        );

        $this->assertApiResponse($cartStatus);
    }

    /**
     * @test
     */
    public function test_read_cart_status()
    {
        $cartStatus = CartStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cart_statuses/'.$cartStatus->id
        );

        $this->assertApiResponse($cartStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_cart_status()
    {
        $cartStatus = CartStatus::factory()->create();
        $editedCartStatus = CartStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cart_statuses/'.$cartStatus->id,
            $editedCartStatus
        );

        $this->assertApiResponse($editedCartStatus);
    }

    /**
     * @test
     */
    public function test_delete_cart_status()
    {
        $cartStatus = CartStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cart_statuses/'.$cartStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cart_statuses/'.$cartStatus->id
        );

        $this->response->assertStatus(404);
    }
}
