<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace smn\lazyc\rbac;

/**
 * Description of Role
 *
 * @author A760526
 */
class Role implements RoleInterface {

    /**
     * Indice dell'array per gestire i permessi
     * @var Int 
     */
    protected $index = 0;

    /**
     * Lista dei permessi
     * @var Array 
     */
    protected $perms = [];

    /**
     * Nome del ruolo
     * @var String 
     */
    protected $name;

    /**
     * Istanzia la classe. Il nome è obbligatorio, la lista dei permessi facoltativa
     * @param type $name
     * @param type $roles
     */
    public function __construct($name, $perms = []) {
        $this->setName($name);
        foreach($perms as $perm) {
            $this->addPerm($perm);
        }
    }

    /**
     * Aggiunge un permesso al ruolo
     * @param \smn\lazyc\rbac\String $name
     * @return \smn\lazyc\rbac\RoleInterface
     * @throws RoleException
     */
    public function addPerm(String $name): \smn\lazyc\rbac\RoleInterface {
        if ($this->hasPerm($name)) {
            throw new RoleException(RoleException::ROLE_ALREADY_SET);
        }
        $this->perms[] = $name;
        return $this;
    }

    /**
     * Cancella tutti i permessi
     * @return void
     */
    public function clearPerms(): void {
        $this->perms = [];
    }

    /**
     * Restituisce tutti i permessi del ruolo
     * @return array
     */
    public function getAllPerms(): Array {
        return $this->perms;
    }

    /**
     * Restituisce il nome del ruolo
     * @return \smn\lazyc\rbac\String
     */
    public function getName(): String {
        return $this->name;
    }

    /**
     * 
     * @param \smn\lazyc\rbac\String $name
     * @return \smn\lazyc\rbac\Bool
     */
    public function hasPerm(String $name): Bool {
        $search = array_search($name, $this->perms);
        return ($search === false) ? false : true;
    }

    /**
     * Modifica il nome di un permesso
     * @param \smn\lazyc\rbac\String $oldname
     * @param \smn\lazyc\rbac\String $newname
     * @throws RoleException
     */
    public function modifyPerm(String $oldname, String $newname) {
        if (($this->hasPerm($oldname)) || ($this->hasPerm($newname))) {
            throw new RoleException(RoleException::ROLE_ALREADY_SET);
        }
        $key = array_search($oldname, $this->perms);
        $this->perms[$key] = $newname;
    }

    /**
     * Rimuove un permesso. Se non esiste genera una RoleException 
     * @param \smn\lazyc\rbac\String $name
     * @return \smn\lazyc\rbac\RoleInterface
     * @throws RoleException
     */
    public function removePerm(String $name): \smn\lazyc\rbac\RoleInterface {
        if (!$this->hasPerm($name)) {
            throw new RoleException(RoleException::ROLE_PERMISSION_NOT_FOUND);
        }
        unset($this->perms[$name]);
    }

    /**
     * Configura il nome del ruolo
     * @param \smn\lazyc\rbac\String $name
     */
    public function setName(String $name) {
        $this->name = $name;
    }

    /* inherit method from \Iterator */

    public function current() {
        return $this->perms[$this->index];
    }

    public function key(): \scalar {
        return $this->index;
    }

    public function next(): void {
        ++$this->index;
    }

    public function rewind(): void {
        $this->index = 0;
    }

    public function valid(): bool {
        return isset($this->perms[$this->index]);
    }

}
