<?php namespace Tests\Repositories;

use App\Models\ReturnStatus;
use App\Repositories\ReturnStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ReturnStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReturnStatusRepository
     */
    protected $returnStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->returnStatusRepo = \App::make(ReturnStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_return_status()
    {
        $returnStatus = ReturnStatus::factory()->make()->toArray();

        $createdReturnStatus = $this->returnStatusRepo->create($returnStatus);

        $createdReturnStatus = $createdReturnStatus->toArray();
        $this->assertArrayHasKey('id', $createdReturnStatus);
        $this->assertNotNull($createdReturnStatus['id'], 'Created ReturnStatus must have id specified');
        $this->assertNotNull(ReturnStatus::find($createdReturnStatus['id']), 'ReturnStatus with given id must be in DB');
        $this->assertModelData($returnStatus, $createdReturnStatus);
    }

    /**
     * @test read
     */
    public function test_read_return_status()
    {
        $returnStatus = ReturnStatus::factory()->create();

        $dbReturnStatus = $this->returnStatusRepo->find($returnStatus->id);

        $dbReturnStatus = $dbReturnStatus->toArray();
        $this->assertModelData($returnStatus->toArray(), $dbReturnStatus);
    }

    /**
     * @test update
     */
    public function test_update_return_status()
    {
        $returnStatus = ReturnStatus::factory()->create();
        $fakeReturnStatus = ReturnStatus::factory()->make()->toArray();

        $updatedReturnStatus = $this->returnStatusRepo->update($fakeReturnStatus, $returnStatus->id);

        $this->assertModelData($fakeReturnStatus, $updatedReturnStatus->toArray());
        $dbReturnStatus = $this->returnStatusRepo->find($returnStatus->id);
        $this->assertModelData($fakeReturnStatus, $dbReturnStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_return_status()
    {
        $returnStatus = ReturnStatus::factory()->create();

        $resp = $this->returnStatusRepo->delete($returnStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(ReturnStatus::find($returnStatus->id), 'ReturnStatus should not exist in DB');
    }
}
