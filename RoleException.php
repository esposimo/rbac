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
class RoleException extends RbacException {

    const ROLE_ALREADY_SET              = 100;
    const ROLE_PERMISSION_EMPTY         = 101;
    const ROLE_PERMISSION_NOT_FOUND     = 102;

    protected $error_msgs = [
        self::PERMISSION_ALREADY_SET => 'Permesso presente',
        self::ROLE_PERMISSION_EMPTY => 'Nessun permesso configurato per questo ruolo',
        self::ROLE_PERMISSION_NOT_FOUND => 'Permesso non trovato'
    ];
    
    
}
