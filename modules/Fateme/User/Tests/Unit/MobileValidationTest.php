<?php

namespace Fateme\User\Tests\Unit;

use Fateme\User\Rules\validMobile;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_mobile_can_not_be_less_than_10_character()
    {
        $failedMessage = null;

        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };

        (new validMobile())->validate('', '912345671', $fail);

        $this->assertNotNull($failedMessage);
    }

    public function test_mobile_can_not_be_more_than_10_character()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
        $result = (new validMobile())->validate(attribute:'',value:'', fail: $fail);
        $this->assertEquals(0,$result);
    }

    public function test_mobile_should_start_by_9()
    {
        $fail = function (string $message) use (&$failedMessage) {
            $failedMessage = $message;
        };
        $result = (new validMobile())->validate(attribute:'',value:'', fail: $fail);
        $this->assertEquals(0,$result);
    }
}
