<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Person;

class PersonTest extends TestCase
{
    private $path = '/api/person';

    public function test_create_person()
    {
        $person = Person::factory()->make();

        $this->postJson($this->path, $person->toArray())
            ->assertCreated();

        $this->assertDatabaseHas('people', ['name' => $person->name]);
    }

    public function test_show_person()
    {
        $person = Person::factory()->create();

        $response = $this->getJson($this->path . '/' .  $person->getRouteKey());
        $response->assertOk();
        $response->assertJsonFragment($person->toArray());
    }

    public function test_update_person()
    {
        $person = Person::factory()->create();
        $newDataPerson = Person::factory()->make();

        $response = $this->putJson($this->path . '/' . $person->getRouteKey(), $newDataPerson->toArray());
        $response->assertOk();
        $response->assertJsonFragment($newDataPerson->toArray());
    }

    public function test_list_person()
    {
        Person::factory()->count(10)->create();

        $response = $this->get($this->path);
        $response->assertOk();
        $response->assertJsonCount(10);
    }

    public function test_delete_person()
    {
        $person = Person::factory()->create();
        $this->delete($this->path . '/' . $person->getRouteKey())
            ->assertNoContent();

        $this->assertDatabaseCount('people', 0);
    }
}
