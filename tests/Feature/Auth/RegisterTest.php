<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\PersonalAccessClient;

class RegisterTest extends TestCase
{
    /**
     * A basic Register Successfully test.
     *
     * @return void
     */
    public function testRegisterSuccessfully()
    {
        PersonalAccessClient::create([
            'client_id' => 2
        ]);
        $this->withoutExceptionHandling();
        $register = [
            'name' => 'UserTest',
            'email' => 'user2@test.com',
            'password' => 'testpass',
            'password_confirmation' => 'testpass'
        ];

        $this->json('POST', 'api/register', $register)
            ->assertStatus(201)
            ->assertJsonStructure([
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }


}
