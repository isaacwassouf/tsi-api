<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChallengeTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        // Create a user and log in before each test
        $this->actingAs($this->user);
    }

    /**
     * A test to check if the standard challenge can be created successfully.
     */
    public function testCreateStandardChallengeSuccessfully(): void
    {
        $response = $this->post('/challenges', [
            'challenge_type' => 'standard',
            'quote_id' => '1XMK2',
            'time_taken' => 60,
            'wpm' => 60,
            'accuracy' => 100,
        ]);

        $response->assertStatus(201);
    }

    /**
     * A test to check if the countdown challenge can be created successfully.
     */
    public function testCreateCountDownChallengeSuccessfully(): void
    {
        $response = $this->post('/challenges', [
            'challenge_type' => 'countdown',
            'quote_id' => '1XMK2',
            'completed_text' => 'This is a test',
            'time_taken' => 42,
            'wpm' => 87,
            'accuracy' => 90,
        ]);

        $response->assertStatus(201);
    }

    /**
     * A test to check if the challenge should fail to be created.
     */
    public function testFailedCreateChallenge(): void
    {
        $response = $this->post('/challenges', [
            'challenge_type' => 'some random type',
            'quote_id' => '1XMK2',
            'time_taken' => 60,
            'wpm' => 60,
            'accuracy' => 100,
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test to check the show endpoint to get a challenge.
     */
    public function testIndexChallengeSuccessfully(): void
    {
        $this->user->challenges()->create([
            'challenge_type' => 'standard',
            'quote_id' => '1XMK2',
            'time_taken' => 60,
            'wpm' => 60,
            'accuracy' => 100,
        ]);

        $this->user->challenges()->create([
            'challenge_type' => 'countdown',
            'quote_id' => '1XMK2',
            'completed_text' => 'This is a test',
            'time_taken' => 60,
            'wpm' => 60,
            'accuracy' => 100,
        ]);

        $this->user->challenges()->create([
            'challenge_type' => 'standard',
            'quote_id' => '1XMK2',
            'time_taken' => 60,
            'wpm' => 60,
            'accuracy' => 100,
        ]);

        $response = $this->get('/challenges/');

        $response->assertStatus(200);
    }
}
