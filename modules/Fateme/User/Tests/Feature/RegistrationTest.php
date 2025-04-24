<?php

namespace Fateme\User\Tests\Feature;

use Fateme\User\Models\User;
use Fateme\User\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
public function test_user_can_see_register_form()
{
$response = $this->get(route('register'));
$response->assertStatus(200);
}

    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();

        $response= $this->registerNewUser();

        $response->assertRedirect(route('home'));

        $this->assertCount(1, User::all());
    }

    public function test_user_have_to_verify_account()
    {
        $this->registerNewUser();

        $response=$this->get(route('home'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_verify_account()
    {
        $user= User::create(
            [
                'name' => 'fateme',
                'email' => 'fabbaszadeh77@yahoo.com',
                'password' => bcrypt('A!123a'),
            ]
        );
        $code=VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code,now()->addDay());
        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();
        $this->post(route('verification.verify'), ['verify_code' => $code]);

        $this->assertEquals(true,$user->fresh()->hasVerifiedEmail());
    }



    public function test_verified_user_can_see_home_page()
    {
        $this->registerNewUser();
        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();

        $response=$this->get(route('home'));
        $response->assertOk();
    }

    /**
     * @returnvoid
     */
    public function registerNewUser()
    {
        return $this->post(route('register'), [
            'name' => 'Fateme',
            'email' => 'abbaszadehf99@gmail.com',
            'mobile' => '9124622367',
            'password' => 'As25@#',
            'password_confirmation' => 'As25@#',
        ]);
    }
}
