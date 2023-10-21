<?php

require_once('./src/crud.php');

class Etudiant{
    protected string $nom;
    protected string $prenom;
    protected string $telephone;
    protected string $mail;
    protected string $adresse;

    public function __construct($nom,$prenom,$telephone,$mail,$adresse){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->mail = $mail;
        $this->adresse = $adresse;
    }


        public function getNom(): string {
            return $this->nom;
        }
    
        public function setNom(string $nom): void {
            $this->nom = $nom;
        }
    
        public function getPrenom(): string {
            return $this->prenom;
        }
    
        public function setPrenom(string $prenom): void {
            $this->prenom = $prenom;
        }
    
        public function getTelephone(): string {
            return $this->telephone;
        }
    
        public function setTelephone(string $telephone): void {
            $this->telephone = $telephone;
        }
    
        public function getMail(): string {
            return $this->mail;
        }

        public function setMail(string $mail): void {
            $this->mail = $mail;
        }
    
        public function getAdresse(): string {
            return $this->adresse;
        }
    
        public function setAdresse(string $adresse): void {
            $this->adresse = $adresse;
        }
}