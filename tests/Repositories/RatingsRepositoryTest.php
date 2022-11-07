<?php namespace Tests\Repositories;

use App\Models\Ratings;
use App\Repositories\RatingsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RatingsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RatingsRepository
     */
    protected $ratingsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ratingsRepo = \App::make(RatingsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ratings()
    {
        $ratings = Ratings::factory()->make()->toArray();

        $createdRatings = $this->ratingsRepo->create($ratings);

        $createdRatings = $createdRatings->toArray();
        $this->assertArrayHasKey('id', $createdRatings);
        $this->assertNotNull($createdRatings['id'], 'Created Ratings must have id specified');
        $this->assertNotNull(Ratings::find($createdRatings['id']), 'Ratings with given id must be in DB');
        $this->assertModelData($ratings, $createdRatings);
    }

    /**
     * @test read
     */
    public function test_read_ratings()
    {
        $ratings = Ratings::factory()->create();

        $dbRatings = $this->ratingsRepo->find($ratings->id);

        $dbRatings = $dbRatings->toArray();
        $this->assertModelData($ratings->toArray(), $dbRatings);
    }

    /**
     * @test update
     */
    public function test_update_ratings()
    {
        $ratings = Ratings::factory()->create();
        $fakeRatings = Ratings::factory()->make()->toArray();

        $updatedRatings = $this->ratingsRepo->update($fakeRatings, $ratings->id);

        $this->assertModelData($fakeRatings, $updatedRatings->toArray());
        $dbRatings = $this->ratingsRepo->find($ratings->id);
        $this->assertModelData($fakeRatings, $dbRatings->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ratings()
    {
        $ratings = Ratings::factory()->create();

        $resp = $this->ratingsRepo->delete($ratings->id);

        $this->assertTrue($resp);
        $this->assertNull(Ratings::find($ratings->id), 'Ratings should not exist in DB');
    }
}
