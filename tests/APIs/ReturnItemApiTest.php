<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ReturnItem;

class ReturnItemApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_return_item()
    {
        $returnItem = ReturnItem::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/return_items', $returnItem
        );

        $this->assertApiResponse($returnItem);
    }

    /**
     * @test
     */
    public function test_read_return_item()
    {
        $returnItem = ReturnItem::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/return_items/'.$returnItem->id
        );

        $this->assertApiResponse($returnItem->toArray());
    }

    /**
     * @test
     */
    public function test_update_return_item()
    {
        $returnItem = ReturnItem::factory()->create();
        $editedReturnItem = ReturnItem::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/return_items/'.$returnItem->id,
            $editedReturnItem
        );

        $this->assertApiResponse($editedReturnItem);
    }

    /**
     * @test
     */
    public function test_delete_return_item()
    {
        $returnItem = ReturnItem::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/return_items/'.$returnItem->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/return_items/'.$returnItem->id
        );

        $this->response->assertStatus(404);
    }
}
