<?php
function getStudentById($connection, $id) {
    $stmt = $connection->prepare("SELECT * FROM etudiant WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}