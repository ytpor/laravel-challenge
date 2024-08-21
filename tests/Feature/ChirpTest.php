<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChirpTest extends TestCase
{
    use RefreshDatabase;

    public const TEST_USERNAME = 'test@test.com';
    public const TEST_PASSWORD = 'password';

    public function test_chirps_screen_can_be_rendered(): void
    {
        $this->user_login();

        $response = $this->get('/chirps');

        $response->assertStatus(200);
    }

    public function test_chirp_can_be_stored(): void
    {
        $user = $this->user_login();
        $this->actingAs($user);

        $data = [
            'message' => 'Message',
            'user_id' => $user->id,
        ];

        $response = $this->post('/chirps', $data);

        $response->assertRedirect('/chirps');
        $response->assertStatus(302);
        $this->assertDatabaseHas('chirps', ['user_id' => $user->id, 'message' => 'Message']);
    }

    public function test_chirp_can_be_updated()
    {
        $user = $this->user_login();
        $this->actingAs($user);

        $chirp = Chirp::factory()->create(['user_id' => $user->id]);
        $updatedData = [
            'message' => 'Updated message',
        ];

        $response = $this->put("/chirps/{$chirp->id}", $updatedData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('chirps', ['user_id' => $user->id, 'message' => 'Updated message']);
    }

    public function test_chirp_can_be_destroyed()
    {
        $user = $this->user_login();
        $this->actingAs($user);

        $chirp = Chirp::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/chirps/{$chirp->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('chirps', ['id' => $chirp->id]);
    }

    private function user_login(): User
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => self::TEST_PASSWORD,
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(route('dashboard', absolute: false));

        return $user;
    }
}
