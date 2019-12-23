<?php

/*
Un User deve avere un nome univoco
Un Utente può avere più ruoli (che a loro volta hanno più permessi) 
Un Oggetto User deve essere in grado di verificare se ha o meno un permesso tra i vari ruoli
	Per validare oltre al nome del permesso è necessario anche il nome del ruolo
Ad un utente possono essere aggiunti/rimossi on the fly permessi di un ruolo o interi ruoli
 */

namespace smn\lazyc\rbac;

/**
 *
 * @author A760526
 */
interface UserInterface {
    
    
    /**
     * Aggiunge un ruolo. Se il ruolo già esiste genera eccezione
     * @param \smn\lazyc\rbac\RoleInterface $role
     * @return self
     * @throws UserException
     */
    public function addRole(RoleInterface $role);
        
    /**
     * Rimuove un ruolo. Se il ruolo non esiste genera eccezione
     * @param \smn\lazyc\rbac\String $name
     * @return self
     * @throws UserException
     */
    public function removeRole(String $name);
    
    
    
    /**
     * Configura il nome dell'utente
     * @param \smn\lazyc\rbac\String $name
     */
    public function setName(String $name);
    
    /**
     * Restituisce il nome dell'utente
     * @return String
     */
    public function getName();
    
    
    /**
     * Verifica se l'utente ha il ruolo $role
     * @param \smn\lazyc\rbac\String $role
     * @return Bool
     */
    public function hasRole(String $role);
    
    /**
     * Verifica se l'utente ha il permesso relativo a quel ruolo
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     * @return Bool
     */
    public function hasPermission(String $role, String $permission);
    
    
    /**
     * Aggiunge un permesso al ruolo indicato. Se il ruolo non esiste genera exception
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     * @return self
     * @throws UserException
     */
    public function addPermissionToRole(String $role, String $permission);
    
    
    /**
     * Rimuove un permesso al ruolo indicato
     * @param \smn\lazyc\rbac\String $role
     * @param \smn\lazyc\rbac\String $permission
     */
    public function removePermissionToRole(String $role, String $permission);
    
    
    /**
     * Restituisce una istanza di RoleInterface
     * @param \smn\lazyc\rbac\String $role
     * @return RoleInterface
     */
    public function getRole(String $role);
    
    
    /**
     * Restituisce i ruoli dell'utente
     * @return Array
     */
    public function getRoles();
    
}
