<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Ratings;

class RatingsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ratings()
    {
        $ratings = Ratings::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ratings', $ratings
        );

        $this->assertApiResponse($ratings);
    }

    /**
     * @test
     */
    public function test_read_ratings()
    {
        $ratings = Ratings::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ratings/'.$ratings->id
        );

        $this->assertApiResponse($ratings->toArray());
    }

    /**
     * @test
     */
    public function test_update_ratings()
    {
        $ratings = Ratings::factory()->create();
        $editedRatings = Ratings::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ratings/'.$ratings->id,
            $editedRatings
        );

        $this->assertApiResponse($editedRatings);
    }

    /**
     * @test
     */
    public function test_delete_ratings()
    {
        $ratings = Ratings::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ratings/'.$ratings->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ratings/'.$ratings->id
        );

        $this->response->assertStatus(404);
    }
}
