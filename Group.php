<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace smn\lazyc\rbac;

/**
 * Description of Group
 *
 * @author A760526
 */
class Group implements GroupInterface {

    /**
     * Configura il nome del gruppo
     * @var type 
     */
    protected $name;

    /**
     * Lista dei ruoli
     * @var RoleInterface[]
     */
    protected $roles = array();

    /**
     * Lista degli utenti
     * @var UserInterface[] 
     */
    protected $users = array();

    /**
     * Lista di eventuali sottogruppi
     * @var GroupInterface[] 
     */
    protected $subgroup = array();

    /**
     * Crea un gruppo con nome , lista utenti , e lista ruoli da assegnare a tutti gli utenti
     * @param \smn\lazyc\rbac\String $name
     * @param \smn\lazyc\rbac\UserInterface $users
     * @param \smn\lazyc\rbac\RoleInterface $roles
     */
    public function __construct(String $name, Array $users, Array $roles) {
        $this->setName($name);
        foreach ($users as $user) {
            $this->addUser($user);
        }
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    /*     * *
     * Aggiunge un permesso ad un ruolo del gruppo
     */

    public function addPermissionToRole(String $role, String $permission) {
        $this->getRole($role)->addPerm($permission);
    }

    /**
     * Aggiunge un permesso ad un ruolo del singolo utente del gruppo
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function addPermissionToUser(String $user, String $role, String $permission) {
        $this->getUser($user)->addPermissionToRole($role, $permission);
    }

    /**
     * Aggiunge un ruolo al gruppo. Per ogni ruolo aggiunto, aggiunge il ruolo anche a tutti gli utenti
     * @param \smn\lazyc\rbac\RoleInterface $role
     * @return \smn\lazyc\rbac\GroupInterface
     * @throws GroupException
     */
    public function addRole(RoleInterface $role): \smn\lazyc\rbac\GroupInterface {
        if ($this->hasRole($role->getName())) {
            throw new GroupException(GroupException::GROUP_ROLE_ALREADY_SET);
        }
        foreach($this->getUsers() as $user) {
            $user->addRole($role);
        }
        $this->roles[$role->getName()] = $role;
        return $this;
    }

    /**
     * Aggiunge un intero ruolo ad un utente del gruppo
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\RoleInterface $role
     * @return \smn\lazyc\rbac\GroupInterface
     */
    public function addRoleToUser(String $user, RoleInterface $role): \smn\lazyc\rbac\GroupInterface {
        $this->getUser($user)->addRole($role);
    }

    /**
     * Aggiunge un utente al gruppo
     * @param \smn\lazyc\rbac\UserInterface $user
     * @return \smn\lazyc\rbac\GroupInterface
     * @throws GroupException
     */
    public function addUser(UserInterface $user): \smn\lazyc\rbac\GroupInterface {
        if ($this->hasUser($user->getName())) {
            throw new GroupException(GroupException::GROUP_USER_ALREADY_PRESENT);
        }
        foreach($this->getRoles() as $role) {
            $user->addRole($role);
        }
        $this->users[$user->getName()] = $user;
        return $this;
    }

    /**
     * Restituisce il nome del gruppo
     * @return \smn\lazyc\rbac\String
     */
    public function getName(): String {
        return $this->name;
    }

    /**
     * Restituisce una istanza RoleInterface
     * @param \smn\lazyc\rbac\String $name
     * @return \smn\lazyc\rbac\RoleInterface
     */
    public function getRole(String $name): RoleInterface {
        if (!$this->hasRole($role)) {
            throw new GroupException(GroupException::GROUP_ROLE_NOT_PRESENT);
        }
        return $this->roles[$role];
    }

    /**
     * Restituisce i ruoli di un utente
     * @param \smn\lazyc\rbac\String $user
     * @return RoleInterface[]
     * @throws GroupException
     */
    public function getRolesByUser(String $user) {
        if (!$this->hasRole($name)) {
            throw new GroupException(GroupException::GROUP_USER_NOT_PRESENT);
        }
        return $this->getUser($user)->getRoles();
    }

    /**
     * Restituisce i ruoli del gruppo
     * @return \smn\lazyc\rbac\RoleInterface []
     */
    public function getRoles() {
        return $this->roles;
    }

    public function getUser(String $name): UserInterface {
        if (!$this->hasUser($name)) {
            throw new GroupException(GroupException::GROUP_USER_NOT_PRESENT);
        }
        return $this->users[$name];
    }

    /**
     * Restituisce gli utenti del gruppo
     * @return UserInterface[]
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * Restituisce true o false se $role è un ruolo
     * @param \smn\lazyc\rbac\String $role
     * @return \smn\lazyc\rbac\Bool
     */
    public function hasRole(String $role): Bool {
        return array_key_exists($role, $this->roles);
    }

    /**
     * Restituisce true o false se $name è un utente
     * @param \smn\lazyc\rbac\String $name
     * @return \smn\lazyc\rbac\Bool
     */
    public function hasUser(String $name): Bool {
        return array_key_exists($name, $this->users);
    }

    /**
     * Rimuove un singolo permesso da un ruolo del gruppo
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function removePermissionToRole(String $role, String $permission) {
        $this->getRole($role)->removePerm($permission);
    }

    /**
     * Rimuove il singolo permesso da un ruolo dell'utente del gruppo
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function removePermissionToUser(String $user, String $role, String $permission) {
        $this->getUser($user)->removePermissionToRole($role, $permission);
    }

    /**
     * Rimuove un ruolo dal gruppo
     * @param \smn\lazyc\rbac\String $role
     * @return \smn\lazyc\rbac\GroupInterface
     * @throws GroupException
     */
    public function removeRole(String $role): \smn\lazyc\rbac\GroupInterface {
        if (!$this->hasRole($role)) {
            throw new GroupException(GroupException::GROUP_ROLE_NOT_PRESENT);
        }
        foreach($this->getUsers() as $user) {
            $user->removeRole($role);
        }
        unset($this->roles[$role]);
    }

    /**
     * Rimuove un singolop ruolo da un utente del gruppo
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @return \smn\lazyc\rbac\GroupInterface
     */
    public function removeRoleToUser(String $user, String $role): \smn\lazyc\rbac\GroupInterface {
        $this->getUser($user)->removeRole($role);
    }

    /**
     * Rimuove un utente dal gruppo
     * @param \smn\lazyc\rbac\String $user
     * @return \smn\lazyc\rbac\GroupInterface
     * @throws GroupException
     */
    public function removeUser(String $user): \smn\lazyc\rbac\GroupInterface {
        if (!$this->hasUser($user)) {
            throw new GroupException(GroupException::GROUP_USER_NOT_PRESENT);
        }
        unset($this->users[$user]);
    }

    /**
     * Configura il nome del gruppo
     * @param \smn\lazyc\rbac\String $name
     */
    public function setName(String $name) {
        $this->name = $name;
    }

    public function validatePermission(String $user, String $role, String $permission): Bool {
        try {
            return $this->getUser($user)->hasPermission($role, $permission);
        } catch (UserException $ex) {
            return false;
        } catch (RoleException $ex) {
            return false;
        }
    }

    /**
     * Aggiunge un gruppo alla lista dei sotto gruppi
     * @param \smn\lazyc\rbac\GroupInterface $group
     * @throws GroupException
     */
    public function addGroup(GroupInterface $group) {
        if ($this->hasGroup($group->getName())) {
            throw new GroupException(GroupException::GROUP_ALREADY_EXIST);
        }
        $this->subgroup[$group->getName()] = $group;
    }

    /**
     * Restituisce tutti i sottogruppi del gruppo
     * @return GroupInterface[]
     */
    public function getAllSubGroup() {
        return $this->subgroup;
    }

    /**
     * Restituisce il sotto gruppo $name
     * @param \smn\lazyc\rbac\String $name
     * @return GroupInterface
     * @throws GroupException
     */
    public function getSubGroup(String $name) {
        if (!$this->hasGroup($name)) {
            throw new GroupException(GroupException::GROUP_NOT_EXIST);
        }
        return $this->subgroup[$name];
    }

    /**
     * Restituisce true o false se il sotto gruppo esiste o meno
     * @param \smn\lazyc\rbac\String $name
     * @return Bool
     */
    public function hasGroup(String $name) {
        return array_key_exists($name, $this->subgroup);
    }

    /**
     * Restituisce una istanza di classe GroupInterface
     * @param \smn\lazyc\rbac\String $name
     * @return GroupInterface
     * @throws GroupException
     */
    public function remomeGroup(String $name) {
        if (!$this->hasGroup($name)) {
            throw new GroupException(GroupException::GROUP_NOT_EXIST);
        }
        return $this->subgroup[$name];
    }

    /**
     * Cancella tutti i ruoli del gruppo
     */
    public function clearAllRoles() {
        $this->roles = array();
    }

    /**
     * Cancella tutti i sotto gruppi
     */
    public function clearAllSubGroup() {
        $this->subgroup = array();
    }

    /**
     * Cancella tutti gli utenti del gruppo
     */
    public function clearAllUsers() {
        $this->users = array();
    }

}
