<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Photo;

class PhotoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_photo()
    {
        $photo = Photo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/photos', $photo
        );

        $this->assertApiResponse($photo);
    }

    /**
     * @test
     */
    public function test_read_photo()
    {
        $photo = Photo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/photos/'.$photo->id
        );

        $this->assertApiResponse($photo->toArray());
    }

    /**
     * @test
     */
    public function test_update_photo()
    {
        $photo = Photo::factory()->create();
        $editedPhoto = Photo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/photos/'.$photo->id,
            $editedPhoto
        );

        $this->assertApiResponse($editedPhoto);
    }

    /**
     * @test
     */
    public function test_delete_photo()
    {
        $photo = Photo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/photos/'.$photo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/photos/'.$photo->id
        );

        $this->response->assertStatus(404);
    }
}
