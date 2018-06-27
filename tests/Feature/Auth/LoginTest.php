<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => [
                        "The email field is required."
                    ],
                    'password' => [
                        "The password field is required."
                    ]
                ]
            ]);
    }


    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'mama@test.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);

        $payload = ['email' => 'mama@test.com', 'password' => '123456'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200);

    }


}
