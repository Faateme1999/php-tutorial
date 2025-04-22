<?php

namespace Tests\Unit;

use Fateme\User\Rules\validMobile;
use Fateme\User\Rules\validPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_password_should_not_be_less_than_6_character()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
       $result = (new validPassword())->validate(attribute:'',value:'', fail: $fail);
       $this->assertEquals(0,$result);
    }

    public function test_password_should_include_sign_character()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
        $result = (new validPassword())->validate(attribute:'',value:'', fail: $fail);
        $this->assertEquals(0,$result);
    }

    public function test_password_should_include_digit_character()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
        $result = (new validPassword())->validate(attribute:'',value:'', fail: $fail);
        $this->assertEquals(0,$result);
    }

    public function test_password_should_include_Capital_character()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
        $result = (new validPassword())->validate(attribute:'',value:'', fail: $fail);
        $this->assertEquals(0,$result);
    }

    public function test_password_should_include_small_character()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
        $result = (new validPassword())->validate(attribute:'',value:'', fail: $fail);
        $this->assertEquals(0,$result);
    }
}
