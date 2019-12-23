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
class GroupException extends RbacException {

    const GROUP_ROLE_ALREADY_SET              = 100;
    const GROUP_ROLE_NOT_PRESENT              = 101;
    const GROUP_USER_ALREADY_PRESENT          = 102;
    const GROUP_USER_NOT_PRESENT              = 103;
    const GROUP_USER_OR_ROLE_NOT_PRESENT      = 104;
    const GROUP_ALREADY_EXIST                 = 105;
    const GROUP_NOT_EXIST                     = 106;

    protected $error_msgs = [
        self::GROUP_ROLE_ALREADY_SET => 'Ruolo già presente',
        self::GROUP_ROLE_NOT_PRESENT => 'Ruolo non presente',
        self::GROUP_USER_ALREADY_PRESENT => 'User già presente in questo gruppo',
        self::GROUP_USER_NOT_PRESENT => 'Utente non presente in questo gruppo',
        self::GROUP_USER_OR_ROLE_NOT_PRESENT => 'Utente o ruolo non esistente',
        self::GROUP_ALREADY_EXIST => 'Sotto gruppo già esistente',
        self::GROUP_NOT_EXIST => 'Sotto gruppo non esistente'
    ];
    
    
}
