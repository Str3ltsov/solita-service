<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Returns;

class ReturnsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_returns()
    {
        $returns = Returns::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/returns', $returns
        );

        $this->assertApiResponse($returns);
    }

    /**
     * @test
     */
    public function test_read_returns()
    {
        $returns = Returns::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/returns/'.$returns->id
        );

        $this->assertApiResponse($returns->toArray());
    }

    /**
     * @test
     */
    public function test_update_returns()
    {
        $returns = Returns::factory()->create();
        $editedReturns = Returns::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/returns/'.$returns->id,
            $editedReturns
        );

        $this->assertApiResponse($editedReturns);
    }

    /**
     * @test
     */
    public function test_delete_returns()
    {
        $returns = Returns::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/returns/'.$returns->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/returns/'.$returns->id
        );

        $this->response->assertStatus(404);
    }
}
