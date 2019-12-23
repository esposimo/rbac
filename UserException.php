<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace smn\lazyc\rbac;

/**
 * Description of RoleException
 *
 * @author A760526
 */
class UserException extends RbacException {

    const ROLE_NOT_PRESENT              = 100;
    const ROLE_ALREADY_PRESENT          = 101;
    const USER_NOT_HAVE_PERMISSION      = 102;
    
    protected $error_msgs = [
        self::ROLE_NOT_PRESENT => 'Ruolo non presente',
        self::ROLE_ALREADY_PRESENT => 'Ruolo già presente',
        self::USER_NOT_HAVE_PERMISSION => 'Utente non ha il ruolo'
    ];
    
    
}
