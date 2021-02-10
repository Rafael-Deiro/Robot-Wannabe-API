<?php

namespace Tests\Feature\API\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_authenticate_with_sanctum()
    {
        $user = Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/api/user');

        $response->assertOk();
        $response->assertJsonPath('email', $user->email);
    }

    public function test_user_can_create_token()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/tokens', [
            'token_name' => 'testing token'
        ]);
        $response->assertOk();
        $response->assertJsonStructure([ "token" ]);
    }
}
