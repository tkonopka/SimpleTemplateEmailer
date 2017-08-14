<?php

use PHPUnit\Framework\TestCase;

require_once "src/SimpleEmailer.php";

/**
 * Tests for SimpleEmailer.
 * 
 * @covers SimpleEmailer
 */
final class SimpleEmailerTest extends TestCase {

    /*
     * This one works if the constructor returns without errors. 
     */
    public function testConsructor() {
        $mailer = new tkonopka\SimpleEmailer\SimpleEmailer("abc@abc.com");
        $this->assertEquals(0, 0);
    }

}
