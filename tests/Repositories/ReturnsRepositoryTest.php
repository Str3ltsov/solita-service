<?php namespace Tests\Repositories;

use App\Models\Returns;
use App\Repositories\ReturnsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ReturnsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReturnsRepository
     */
    protected $returnsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->returnsRepo = \App::make(ReturnsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_returns()
    {
        $returns = Returns::factory()->make()->toArray();

        $createdReturns = $this->returnsRepo->create($returns);

        $createdReturns = $createdReturns->toArray();
        $this->assertArrayHasKey('id', $createdReturns);
        $this->assertNotNull($createdReturns['id'], 'Created Returns must have id specified');
        $this->assertNotNull(Returns::find($createdReturns['id']), 'Returns with given id must be in DB');
        $this->assertModelData($returns, $createdReturns);
    }

    /**
     * @test read
     */
    public function test_read_returns()
    {
        $returns = Returns::factory()->create();

        $dbReturns = $this->returnsRepo->find($returns->id);

        $dbReturns = $dbReturns->toArray();
        $this->assertModelData($returns->toArray(), $dbReturns);
    }

    /**
     * @test update
     */
    public function test_update_returns()
    {
        $returns = Returns::factory()->create();
        $fakeReturns = Returns::factory()->make()->toArray();

        $updatedReturns = $this->returnsRepo->update($fakeReturns, $returns->id);

        $this->assertModelData($fakeReturns, $updatedReturns->toArray());
        $dbReturns = $this->returnsRepo->find($returns->id);
        $this->assertModelData($fakeReturns, $dbReturns->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_returns()
    {
        $returns = Returns::factory()->create();

        $resp = $this->returnsRepo->delete($returns->id);

        $this->assertTrue($resp);
        $this->assertNull(Returns::find($returns->id), 'Returns should not exist in DB');
    }
}
