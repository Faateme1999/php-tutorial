<?php

namespace Fateme\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_reset_password_request_form()
    {
        $this->get(route('password.request'))->assertOk();

}

public function test_user_can_see_enter_verify_code_form_by_correct_email()
{
    $this->call('get',route('password.sendVerifyCodeEmail'),['email' =>'fabbaszadeh77@yahoo.com'])
        ->assertOk();
}

    public function test_user_cannot_see_enter_verify_code_form_by_wrong_email()
    {
        $this->call('get',route('password.sendVerifyCodeEmail'),['email' =>'fabbaszadeh77.com'])
            ->assertStatus(302);
    }

    public function test_user_banned_after_6_attempts_to_reset_password()
    {
       for ($i = 0; $i <= 6; $i++) {
           $this->post(route('password.checkVerifyCode'), ['verify_code','email' =>'fabbaszadeh77@yahoo.com'])
               ->assertStatus(302);
       }
       $this->post(route('password.checkVerifyCode'),['verify_code','email' =>'fabbaszadeh77@yahoo.com'])
           ->assertStatus(429);
    }
}
