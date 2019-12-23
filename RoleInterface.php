<?php
namespace smn\lazyc\rbac;
/*
 * Interfaccia per i ruoli
 * Una classe di tipo RoleInterface 
 *      deve avere un nome
 *      ha una lista di permessi
 * La coppia nome-ruolo + permesso rende univoco quel permesso
 * La classe si occupa di aggiungere/rimuovere/modificare permessi e verificare che un permesso sia o meno presente
 * E' presente anche un metodo astratto che restituisce, fornito il permesso, un nome univoco di quel permesso in formato stringa
 */

/**
 *
 * @author A760526
 */
interface RoleInterface extends \Iterator {
    
    /**
     * Configura il nome del permesso
     * @param \smn\lazyc\rbac\String $name
     */
    public function setName(String $name);
    
    /**
     * Restituisce il nome del permesso
     * @return String
     */
    public function getName();
    
    /**
     * Aggiunge un permesso. Se già presente lancia una RoleException
     * @param \smn\lazyc\rbac\String $name
     * @return self
     * @throws RoleException
     */
    public function addPerm(String $name);
    
    /**
     * Rimuove un permesso. Se già presente lancia una RoleException
     * @param \smn\lazyc\rbac\String $name
     * @return self
     * @throws RoleException
     */
    public function removePerm(String $name);
    
    /**
     * Modifica il nome di un permesso in un altro. 
     * Se $oldname o $newname già esistono , lancia una RoleException
     * @param \smn\lazyc\rbac\String $oldname
     * @param \smn\lazyc\rbac\String $newname
     * @throws RoleException
     */
    public function modifyPerm(String $oldname, String $newname);
    
    
    /**
     * Restituisce true o false se un permesso $name esiste nel ruolo
     * @param \smn\lazyc\rbac\String $name
     * @return Bool
     */
    public function hasPerm(String $name);
    
    
    /**
     * Restituisce l'array con tutti i permessi
     * @return Array
     */
    public function getAllPerms();
    
    /**
     * Cancella tutti i permessi
     * @return void
     */
    public function clearPerms();
    
    
}
