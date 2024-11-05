<?php namespace Tests\Repositories;

use App\Models\Photo;
use App\Repositories\PhotoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PhotoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PhotoRepository
     */
    protected $photoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->photoRepo = \App::make(PhotoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_photo()
    {
        $photo = Photo::factory()->make()->toArray();

        $createdPhoto = $this->photoRepo->create($photo);

        $createdPhoto = $createdPhoto->toArray();
        $this->assertArrayHasKey('id', $createdPhoto);
        $this->assertNotNull($createdPhoto['id'], 'Created Photo must have id specified');
        $this->assertNotNull(Photo::find($createdPhoto['id']), 'Photo with given id must be in DB');
        $this->assertModelData($photo, $createdPhoto);
    }

    /**
     * @test read
     */
    public function test_read_photo()
    {
        $photo = Photo::factory()->create();

        $dbPhoto = $this->photoRepo->find($photo->id);

        $dbPhoto = $dbPhoto->toArray();
        $this->assertModelData($photo->toArray(), $dbPhoto);
    }

    /**
     * @test update
     */
    public function test_update_photo()
    {
        $photo = Photo::factory()->create();
        $fakePhoto = Photo::factory()->make()->toArray();

        $updatedPhoto = $this->photoRepo->update($fakePhoto, $photo->id);

        $this->assertModelData($fakePhoto, $updatedPhoto->toArray());
        $dbPhoto = $this->photoRepo->find($photo->id);
        $this->assertModelData($fakePhoto, $dbPhoto->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_photo()
    {
        $photo = Photo::factory()->create();

        $resp = $this->photoRepo->delete($photo->id);

        $this->assertTrue($resp);
        $this->assertNull(Photo::find($photo->id), 'Photo should not exist in DB');
    }
}
