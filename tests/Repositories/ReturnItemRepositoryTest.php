<?php namespace Tests\Repositories;

use App\Models\ReturnItem;
use App\Repositories\ReturnItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ReturnItemRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReturnItemRepository
     */
    protected $returnItemRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->returnItemRepo = \App::make(ReturnItemRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_return_item()
    {
        $returnItem = ReturnItem::factory()->make()->toArray();

        $createdReturnItem = $this->returnItemRepo->create($returnItem);

        $createdReturnItem = $createdReturnItem->toArray();
        $this->assertArrayHasKey('id', $createdReturnItem);
        $this->assertNotNull($createdReturnItem['id'], 'Created ReturnItem must have id specified');
        $this->assertNotNull(ReturnItem::find($createdReturnItem['id']), 'ReturnItem with given id must be in DB');
        $this->assertModelData($returnItem, $createdReturnItem);
    }

    /**
     * @test read
     */
    public function test_read_return_item()
    {
        $returnItem = ReturnItem::factory()->create();

        $dbReturnItem = $this->returnItemRepo->find($returnItem->id);

        $dbReturnItem = $dbReturnItem->toArray();
        $this->assertModelData($returnItem->toArray(), $dbReturnItem);
    }

    /**
     * @test update
     */
    public function test_update_return_item()
    {
        $returnItem = ReturnItem::factory()->create();
        $fakeReturnItem = ReturnItem::factory()->make()->toArray();

        $updatedReturnItem = $this->returnItemRepo->update($fakeReturnItem, $returnItem->id);

        $this->assertModelData($fakeReturnItem, $updatedReturnItem->toArray());
        $dbReturnItem = $this->returnItemRepo->find($returnItem->id);
        $this->assertModelData($fakeReturnItem, $dbReturnItem->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_return_item()
    {
        $returnItem = ReturnItem::factory()->create();

        $resp = $this->returnItemRepo->delete($returnItem->id);

        $this->assertTrue($resp);
        $this->assertNull(ReturnItem::find($returnItem->id), 'ReturnItem should not exist in DB');
    }
}
