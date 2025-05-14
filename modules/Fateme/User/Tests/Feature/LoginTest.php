<?php

namespace Fateme\User\Tests\Feature;

use Fateme\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use withFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_login_by_email()
    {
      $user= User::create(
          [
          'name' => $this->faker->name,
          'email' => $this->faker->unique()->safeEmail,
          'password' => bcrypt('A!123a'),
      ]
      );

      $this->post(route('login.submit'), [
          'email' => $user->email,
          'password' => 'A!123a'
      ]);
      $this->assertAuthenticated();
    }


    public function test_user_can_login_by_mobile()
    {
        $user= User::create(
            [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
//                'mobile' => $this->faker->e164PhoneNumber,
                'mobile'=>'9124622367',
                'password' => bcrypt('A!123a'),
            ]
        );

        $this->post(route('login.submit'), [
            'email' => $user->mobile,
            'password' => 'A!123a'
        ]);
        $this->assertAuthenticated();
    }
}
