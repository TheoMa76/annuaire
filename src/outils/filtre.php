<?php

require_once "./configs/bootstrap.php";

function recherche($connection) {
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    

    $query = "SELECT * FROM votre_table WHERE 
          nom LIKE :search OR 
          prenom LIKE :search OR 
          telephone LIKE :search OR 
          mail LIKE :search OR 
          adresse LIKE :search OR 
          id LIKE :search";

    $searchQuery = '%' . $search . '%';

    $statement = $connection->prepare($query);
    $statement->bindParam(':search', $searchQuery);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
    }
}