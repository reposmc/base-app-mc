<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Nette\Utils\Json;

class JwtTest extends TestCase
{
    /**
     * Login a user using JWT
     *
     * @return Response $response
     */
    public function login()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);

        return $response;
    }

    /**
     * Login a user using JWT
     *
     * @return void
     */
    public function test_login_jwt()
    {
        $response = $this->login();

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->whereAllType([
                    'status' => 'string',
                    'message' => 'string',
                    'access_token' => 'string',
                    'token_type' => 'string',
                    'expires_in' => 'integer',
                ])
            );

        $this->assertTrue(true);
    }

    /**
     * Getting the user authenticated.
     *
     * @return void
     */
    public function test_get_user_jwt()
    {
        $user = $this->login();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->json('access_token'),
        ])
        ->postJson('/api/auth/me', []);

        $response
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->whereAllType([
                    'status' => 'string',
                    'message' => 'string',
                    'user' => 'array'
                ])
            );

        $this->assertTrue(true);
    }

    /**
     * Logging out the user authenticated.
     *
     * @return void
     */
    public function test_logout_user_jwt()
    {
        $user = $this->login();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->json('access_token'),
        ])
        ->postJson('/api/auth/logout', []);

        $response
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->whereAllType([
                    'status' => 'string',
                    'message' => 'string',
                ])
            );

        $this->assertTrue(true);
    }
}
