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

        $this->get($this->path . '/' .  $person->id)
            ->assertOk();
    }

    public function test_update_person()
    {
        $person = Person::factory()->create();
        $newDataPerson = Person::factory()->make();

        $this->putJson($this->path . '/' . $person->id, $newDataPerson->toArray())
            ->assertOk();
    }

    public function test_list_person()
    {
        Person::factory()->count(10)->create();
        $this->get($this->path)
            ->assertOk();
    }


    public function test_delete_person()
    {
        $person = Person::factory()->create();
        $this->delete($this->path . '/' . $person->id)
            ->assertNoContent();

        $this->assertDatabaseCount('people', 0);
    }
}
