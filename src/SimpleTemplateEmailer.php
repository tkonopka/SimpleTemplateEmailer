<?php

namespace tkonopka\SimpleEmailer;

use tkonopka\SimpleTemplateFiller;

/*
 * Simple utility to send email using templates
 * 
 * @author Tomasz Konopka
 * @license MIT
 */

class SimpleTemplateEmailer extends SimpleEmailer {

    // template filler
    private $_filler;

    /**
     * Constructor defines an email sender and preps a template filler.
     * 
     * @param string $sender - email address of sender
     * @param string $templatesdir - path to directory with templates
     * @throws Exception
     */
    public function __construct($sender, $templatesdir) {
        parent::__construct($sender);
        $this->_filler = new \tkonopka\SimpleTemplateFiller\SimpleTemplateFiller($templatesdir);        
    }

    /**
     * Prepare and send meail 
     * 
     * @param string $address - email address for recipient
     * @param string $template - name of file holding email content
     * @param array $params - associative array with parameters to template
     * 
     * @return boolean
     */
    public function sendTemplated($address, $template, $params) {

        // use the template filler to generate document
        $content = $this->_filler->fill($template, $params);
        $content2 = explode("\n", $content);

        // extract the subject line and email body
        $subject = trim(array_shift($content2), "# \t\n\r\0\x0B");
        $body = trim(implode("\n", $content2)) . "\n";

        return $this->send($address, $subject, $body);
    }

}
