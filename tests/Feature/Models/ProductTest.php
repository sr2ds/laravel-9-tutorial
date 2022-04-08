<?php

namespace Tests\Feature\Models;

use Tests\TestCase;

class ProductTest extends TestCase
{
    private $path = '/api/products';
    private $model = \App\Models\Product::class;
    private $table = 'products';

    public function test_create_ProductTest()
    {
        $data = $this->model::factory()->make();

        $this->postJson($this->path, ['data' => $data->toArray()])
            ->assertCreated();

        $this->assertDatabaseHas($this->table, $data->toArray());
    }

    public function test_show_ProductTest()
    {
        $data = $this->model::factory()->create();

        $this->get($this->path . '/' .  $data->id)
            ->assertOk();
    }

    public function test_update_ProductTest()
    {
        $data = $this->model::factory()->create();
        $newData = $this->model::factory()->make();

        $this->putJson($this->path . '/' . $data->id, ['data' => $newData->toArray()])
            ->assertOk();
    }

    public function test_list_ProductTest()
    {
        $this->model::factory()->count(10)->create();
        $this->get($this->path)
            ->assertOk();
    }

    public function test_delete_ProductTest()
    {
        $data = $this->model::factory()->create();
        $this->delete($this->path . '/' . $data->id)
            ->assertNoContent();

        $this->assertDatabaseCount($this->table, 0);
    }
}
