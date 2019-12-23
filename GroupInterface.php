<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace smn\lazyc\rbac;

/**
 *
 * @author A760526
 */
interface GroupInterface {
    
    /**
     * Configura il nome del gruppo
     * @param \smn\lazyc\rbac\String $name
     */
    public function setName(String $name);
    
    /**
     * Restituisce il nome del gruppo
     * @return String
     */
    public function getName();
    

    /**
     * Aggiunge un utente al gruppo. Se l'utente già esiste lancia una GroupException
     * @param \smn\lazyc\rbac\UserInterface $user
     * @throws GroupException
     * @return self
     */
    public function addUser(UserInterface $user);
    
    /**
     * Rimuove un utente dal gruppo. Se l'utente non esiste lancia GroupException
     * @param \smn\lazyc\rbac\String $user
     * @throw GroupException
     * @return self
     */
    public function removeUser(String $user);
    
    /**
     * Aggiunge un ruolo al gruppo. Se il ruolo già esiste genera GroupException
     * @param \smn\lazyc\rbac\RoleInterface $role
     * @throw GroupException
     * @return self
     */
    public function addRole(RoleInterface $role);
    
    /**
     * Rimuove un ruolo dal gruppo. Se il ruolo non c'è genera GroupException
     * @param \smn\lazyc\rbac\String $role
     * @throw GroupException
     * @return self
     */
    public function removeRole(String $role);
    
    
    /**
     * Restituisce true/false se un utente esiste o meno nel gruppo
     * @param \smn\lazyc\rbac\String $name
     * @return Bool
     */
    public function hasUser(String $name);
    
    /**
     * Restituisce true/false se un ruolo esiste o meno nel gruppo
     * @param \smn\lazyc\rbac\String $role
     * @return Bool
     */
    public function hasRole(String $role);
    
    
    /**
     * Restituisce una istanza UserInterface dato il nome
     * @param \smn\lazyc\rbac\String $name
     * @return UserInterface
     */
    public function getUser(String $name);
    
    /**
     * Restituisce una istanza RoleInterface dato il nome
     * @param \smn\lazyc\rbac\String $name
     * @return RoleInterface
     */
    public function getRole(String $name);
    
    
    /**
     * Restituisce true o false se l'utente ha o meno il permesso di quel ruolo
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     * @return Bool
     */
    public function validatePermission(String $user, String $role, String $permission);
    
    
    /**
     * Aggiunge un ruolo ad un utente
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\RoleInterface $role
     * @return self
     */
    public function addRoleToUser(String $user, RoleInterface $role);
    
    
    /**
     * Rimuove un ruolo ad un utente del gruppo
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @return self
     */
    public function removeRoleToUser(String $user, String $role);
    
    
    /**
     * Aggiunge un permesso ad un ruolo specifico del gruppo
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function addPermissionToRole(String $role, String $permission);
    
    
    /**
     * Rimuove un permesso da un ruolo del gruppo (non dell'utente)
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function removePermissionToRole(String $role, String $permission);
    
    
    
    /**
     * Aggiunge un permesso ad un ruolo di un utente specifico
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function addPermissionToUser(String $user, String $role, String $permission);
    
    
    /**
     * Rimuove un permesso da un ruolo di un utente
     * @param \smn\lazyc\rbac\String $user
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function removePermissionToUser(String $user, String $role, String $permission);
    
    
    /**
     * Restituisce tutti gli utenti
     * @return Array
     */
    public function getUsers();
    
    /**
     * Restituisce tutti i ruoli
     * @return Array
     */
    public function getRoles();
    
    
    /**
     * Restituisce i ruoli di un utente
     * @param \smn\lazyc\rbac\String $user
     * @return Array
     */
    public function getRolesByUser(String $user);
    
    
    
    /**
     * Aggiunge un sotto gruppo al gruppo
     * @param \smn\lazyc\rbac\GroupInterface $group
     */
    public function addGroup(GroupInterface $group);
    
    /**
     * Rimuove un sotto gruppo dal gruppo
     * @param \smn\lazyc\rbac\String $name
     */
    public function remomeGroup(String $name);
    
    /**
     * Restituisce true o false se il sotto gruppo esiste o meno
     * @param \smn\lazyc\rbac\String $name
     * @return Bool
     */
    public function hasGroup(String $name);
    
    /**
     * Restituisce il sotto gruppo
     * @param \smn\lazyc\rbac\String $name
     * @return GroupInterface
     */
    public function getSubGroup(String $name);
    
    
    /**
     * Restituisce tutti i sotto gruppi
     * @return GroupInterface[]
     */
    public function getAllSubGroup();
    
    /**
     * Cancella tutti i ruoli del gruppo
     */
    public function clearAllRoles();
    
    /**
     * Cancella tutti gli utenti del gruppo
     */
    public function clearAllUsers();
    
    /**
     * Cancella tutti i sotto gruppi del gruppo
     */
    public function clearAllSubGroup();
    
}
