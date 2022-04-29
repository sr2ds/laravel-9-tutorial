<?php

namespace Tests\Feature\Models;

use Tests\TestCase;

class BookTest extends TestCase
{
    private $path = 'api/books';
    private $model = \App\Models\Book::class;
    private $table = 'books';

    public function test_create_BookTest()
    {
        $data = $this->model::factory()->make();

        $this->postJson($this->path, ['data' => $data->toArray()])
            ->assertCreated();

        $this->assertDatabaseHas($this->table, $data->toArray());
    }

    public function test_show_BookTest()
    {
        $data = $this->model::factory()->create();

        $response = $this->getJson($this->path . '/' .  $data->getRouteKey());
        $response->assertOk();
        $response->assertJsonFragment($data->toArray());
    }

    public function test_update_BookTest()
    {
        $data = $this->model::factory()->create();
        $newData = $this->model::factory()->make();

        $response = $this->putJson($this->path . '/' . $data->getRouteKey(), ['data' => $newData->toArray()]);
        $response->assertOk();
        $response->assertJsonFragment($newData->toArray());
    }

    public function test_list_BookTest()
    {
        $this->model::factory()->count(10)->create();

        $response = $this->get($this->path);
        $response->assertOk();
        $response->assertJsonCount(10, 'data');
    }

    public function test_delete_BookTest()
    {
        $data = $this->model::factory()->create();
        $this->delete($this->path . '/' . $data->getRouteKey())
            ->assertNoContent();

        $this->assertDatabaseCount($this->table, 0);
    }
}
