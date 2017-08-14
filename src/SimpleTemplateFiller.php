<?php

namespace tkonopka\SimpleTemplateFiller;

/*
 * Simple utility to fill templates with values
 * 
 * @author Tomasz Konopka
 * @license MIT
 */

class SimpleTemplateFiller {

    // directory holding email templates
    private $_templatesdir;
    // extension of files in templates directory
    private $_extension = "txt";
    // markers in template denoting items to replace
    public $_markers = ["%", "%"];

    /**
     * Constructor. Remembers the location of the templates.
     * 
     * @param string $templatesdir - path to directory with templates
     * @param string $extension - extension for files in templates directory
     * @param string $startmarker - delimiter for placeholders in templates
     * @param string $endmarker - delimiter for placeholders in templates
     * @throws Exception when the directory is not accessible
     */
    public function __construct($templatesdir, $extension="txt", $startmarker="%", $endmarker="%") {
        if (!file_exists($templatesdir)) {
            throw new Exception("Template directory does not exist");
        }
        $this->_templatesdir = $templatesdir;
        $this->_extension = $extension;
        $this->_markers = [$startmarker, $endmarker];
    }

    /**
     * Change the default extension of files in templates directory
     * 
     * (To use templates with different extensions, e.g. some .html and some 
     * .txt, you can set this to the empty string, then specify the full
     * template filename when generating documents)
     * 
     * @param type $extension
     */
    public function setExtension($extension) {
        $this->_extension = $extension;
    }

    /**
     * Set new markers for replace blocks
     *
     * e.g. use "%" and "%" to use templates containing %REPLACE_ME%
     *      use "[" and "]" to use templates containing [REPLACE_ME]
     * 
     * @param string $startmarker - marker for start of replace block 
     * @param string $endmarker - marker for end of replace block
     */
    public function setMarkers($startmarker, $endmarker) {
        $this->_markers = [$startmarker, $endmarker];
    }

    /**
     * Prepare a document using a template and filler values
     * 
     * @param string $template - name of file holding email content
     * @param array $params - associative array with parameters 
     * 
     * @return string
     */
    public function fill($template, $params) {
        // fetch template content from disk
        $templatefile = $this->_templatesdir . "/" . $template . "." . $this->_extension;
        if (!file_exists($templatefile)) {
            throw new Exception("Template file does not exist");
        }
        $content = file_get_contents($templatefile);

        // update the contents of the email usign the data from the $params
        $m1 = $this->_markers[0];
        $m2 = $this->_markers[1];
        
        $searchterms = [];
        $replacevals = [];
        foreach ($params as $key=>$value) {
            $searchterms[] = $m1.$key.$m2;
            $replacevals[] = $value;
        }
        
        return str_replace($searchterms, $replacevals, $content);
    }

}
