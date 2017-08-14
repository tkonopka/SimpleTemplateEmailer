<?php

use PHPUnit\Framework\TestCase;

require_once "src/SimpleTemplateFiller.php";

/**
 * Tests for SimpleTemplateFiller.
 * Each test reads two files from disk: an input and an expected output
 * 
 * @covers SimpleTemplateFiller
 */
final class SimpleTemplateFillerTest extends TestCase {

    public $_filler;
    public $_values;

    protected function setUp() {
        parent::setUp();
        $this->_filler = new tkonopka\SimpleTemplateFiller\SimpleTemplateFiller("tests/templates");        
        $this->_values = json_decode(file_get_contents("tests/values/values.json"));
    }

    public function genericTest($prefix, $extension, $marker1="%", $marker2="%") {
        $expected = file_get_contents("tests/templates/$prefix.filled.$extension");
        $this->_filler->setExtension($extension);
        $this->_filler->setMarkers($marker1, $marker2);        
        $output = $this->_filler->fill($prefix, $this->_values);
        $this->assertEquals($expected, $output);
    }

    public function testOneParam() {
        $this->genericTest("oneParam", "txt");
    }

    public function testOneParamBraces() {
        $this->genericTest("oneParamBraces", "txt", "{{", "}}");
    }
    
}

