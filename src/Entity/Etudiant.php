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

    public function create(){
        $tableName = 'etudiant';
        $query = queryBuilder('c', $tableName, [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'mail' => $this->mail,
            'adresse' => $this->adresse
        ]);
        global $connection;
        dd($query);
            $statement = $connection->prepare($query);
            $statement->execute();
            echo "Étudiant inséré avec succès !";
    }

    public function update($id){
        $tableName = 'etudiant';
        $query = queryBuilder('u', $tableName, [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'mail' => $this->mail,
            'adresse' => $this->adresse,
            'id' => $id
        ]);
    
        global $connection;
        $statement = $connection->prepare($query);
        $statement->execute();
        echo "Étudiant mis à jour avec succès !";

    }
    

    public function delete(){

    }

    public function getAll(){

    }

}