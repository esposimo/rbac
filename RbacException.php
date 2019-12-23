<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace smn\lazyc\rbac;

/**
 * Description of RbacException
 *
 * @author A760526
 */
class RbacException extends \Exception {

    protected $error_msgs = [];

    public function __construct($code, \Throwable $previous = NULL) {
        $message = $this->error_msgs[$code];
        parent::__construct($message, $code, $previous);
    }

}
