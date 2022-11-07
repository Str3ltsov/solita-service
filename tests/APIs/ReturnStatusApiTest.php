<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ReturnStatus;

class ReturnStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_return_status()
    {
        $returnStatus = ReturnStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/return_statuses', $returnStatus
        );

        $this->assertApiResponse($returnStatus);
    }

    /**
     * @test
     */
    public function test_read_return_status()
    {
        $returnStatus = ReturnStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/return_statuses/'.$returnStatus->id
        );

        $this->assertApiResponse($returnStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_return_status()
    {
        $returnStatus = ReturnStatus::factory()->create();
        $editedReturnStatus = ReturnStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/return_statuses/'.$returnStatus->id,
            $editedReturnStatus
        );

        $this->assertApiResponse($editedReturnStatus);
    }

    /**
     * @test
     */
    public function test_delete_return_status()
    {
        $returnStatus = ReturnStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/return_statuses/'.$returnStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/return_statuses/'.$returnStatus->id
        );

        $this->response->assertStatus(404);
    }
}
