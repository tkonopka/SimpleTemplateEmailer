<?php

use PHPUnit\Framework\TestCase;

require_once "src/SimpleTemplateEmailer.php";

/**
 * Tests for SimpleTemplateEmailer.
 * 
 * @covers SimpleTemplateEmailer
 */
final class SimpleTemplateEmailerTest extends TestCase {

    /*
     * This one works if the constructor returns without errors. 
     */
    public function testConsructor() {
        $mailer = new tkonopka\SimpleEmailer\SimpleTemplateEmailer("abc@abc.com", "tests/templates");
        $this->assertEquals(0, 0);
    }

}
