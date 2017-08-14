<?php

namespace tkonopka\SimpleEmailer;

/*
 * Simple utility to send email
 * 
 * @author Tomasz Konopka
 * @license MIT
 */

class SimpleEmailer {

    // email address of the sender
    private $_sender;

    /**
     * Constructor defines the email sender.
     * 
     * @param type $sender
     */
    public function __construct($sender) {
        $this->_sender = $sender;
    }

    /**
     * Change the sender associated with the class instance
     * 
     * @param string $sender - new sender for email
     */
    public function setSender($sender) {
        $this->_sender = $sender;
    }

    /**
     * Send one email 
     * 
     * @param string $address - destination (To:) address
     * @param string $subject 
     * @param string $body
     * 
     * @return boolean
     */
    public function send($address, $subject, $body) {

        // prepare email headers
        $headers = 'From: ' . $this->_sender . " \r\n" .
                'Reply-To: ' . $this->_sender . " \r\n" .
                'X-Mailer: PHP/' . phpversion();

        // send mail and return boolean code
        return mail($address, $subject, $body, $headers);
    }

}
