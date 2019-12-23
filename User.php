<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace smn\lazyc\rbac;

/**
 * Description of User
 *
 * @author A760526
 */
class User implements UserInterface {
    
    /**
     * Nome dell'utente
     * @var String 
     */
    protected $name;
    
    
    /**
     * Lista dei ruoli dell'utente
     * @var RoleInterface[] 
     */
    protected $roles = [];
    
    /**
     * Aggiunge un permesso al volo su un ruolo
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     * @return \smn\lazyc\rbac\UserInterface
     * @throws UserException
     */
    
    public function __construct(String $name) {
        $this->setName($name);
    }
    
    
    public function addPermissionToRole(String $role, String $permission): \smn\lazyc\rbac\UserInterface {
        if (!$this->hasRole($role)) {
            throw new UserException(UserException::ROLE_NOT_PRESENT);
        }
        $instance = $this->getRole($role);
        $instance->addPerm($permission);
    }

    /**
     * Aggiunge un ruolo a l'utente
     * @param \smn\lazyc\rbac\RoleInterface $role
     * @return \smn\lazyc\rbac\UserInterface
     * @throws UserException
     */
    public function addRole(RoleInterface $role): \smn\lazyc\rbac\UserInterface {
        $name = $role->getName();
        if ($this->hasRole($name)) {
            throw new UserException(UserException::ROLE_ALREADY_PRESENT);
        }
        $this->roles[$name] = $role;
        return $this;
    }

    /**
     * Restituisce il nome dell'utente
     * @return \smn\lazyc\rbac\String
     */
    public function getName(): String {
        return $this->name;
    }

    /**
     * Restituisce una instanza di Role
     * @param \smn\lazyc\rbac\String $role
     * @return \smn\lazyc\rbac\RoleInterface
     * @throws UserException
     */
    public function getRole(String $role): RoleInterface {
        if (!$this->hasRole($role)) {
            throw new UserException(UserException::ROLE_NOT_PRESENT);
        }
        return $this->roles[$role];
    }

    /**
     * Verifica se l'utente ha il permesso di quel ruolo
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     * @return \smn\lazyc\rbac\Bool
     * @throws UserException
     */
    public function hasPermission(String $role, String $permission): Bool {
        if (!$this->hasRole($role)) {
            throw new UserException(UserException::ROLE_NOT_PRESENT);
        }
        $instance = $this->getRole($role);
        return $instance->hasPerm($permission);
    }

    /**
     * Restituisce true o false se l'utente ha o meno un permesso
     * @param \smn\lazyc\rbac\String $role
     * @return \smn\lazyc\rbac\Bool
     */
    public function hasRole(String $role): Bool {
        return array_key_exists($role, $this->roles);
    }

    /**
     * Rimuove un ruolo dalla lista dei ruoli.
     * @param \smn\lazyc\rbac\String $role
     * @return \smn\lazyc\rbac\UserInterface
     * @throws UserException
     */
    public function removeRole(String $role): \smn\lazyc\rbac\UserInterface {
        if (!$this->hasRole($role)) {
            throw new UserException(UserException::ROLE_NOT_PRESENT);
        }
        unset($this->roles[$role]);
        return $this;
    }

    /**
     * Configura il nome dell'utente
     * @param \smn\lazyc\rbac\String $name
     */
    public function setName(String $name) {
        $this->name = $name;
    }

    /**
     * Restituisce i ruoli dell'utente
     * @return RoleInterface[]
     */
    public function getRoles() {
        return $this->roles;
    }

    /**
     * Rimuove un sinolo permesso da un ruolo dell'utente
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     * @throws UserException
     */
    public function removePermissionToRole(String $role, String $permission) {
        if (!$this->hasRole($role)) {
            throw new UserException(UserException::ROLE_NOT_PRESENT);
        }
        $instance = $this->getRole($role);
        $instance->removePerm($permission);
    }

}
