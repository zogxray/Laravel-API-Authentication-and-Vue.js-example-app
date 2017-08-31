<?php

namespace Tests\Unit;

use App\Note;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testNoteCreate()
    {
        Passport::actingAs(
            factory(User::class)->create()
        );

        $response = $this->post('/api/note/create', ['title' => 'Test', 'description' => 'Test']);
        $response->original['item']->delete();

        $response->assertStatus(200);
    }

    public function testNoteUpdate()
    {

        $note = Note::inRandomOrder()->first();
        Passport::actingAs(
            User::find($note->user_id)
        );

        $response = $this->post('/api/note/update/'.$note->id, ['title' => 'Test', 'description' => 'Test']);
        $response->original['item']->update([
                'title' => $note->title,
                'description' => $note->description,
            ]);

        $response->assertStatus(200);
    }

}
