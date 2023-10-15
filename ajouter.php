<?php

require_once './configs/bootstrap.php';
ob_start();

if(isset($_GET["page"])){
    fromInc($_GET['page']);
}

$pageContent = [
    "html" => ob_get_clean(),

];
if(isset($_GET["layout"])){
    include "./templates/layout/". $_GET["layout"] .".layout.php";

}else{
    include "./templates/layout/html.layout.php";

}
?>

<style>
form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>

<form action="index.php" method="post">
  <ul>
    <li>
      <label for="nom">Nom&nbsp;:</label>
      <input type="text" id="nom" name="nom" />
    </li>
    <li>
      <label for="prenom">Prénom&nbsp;:</label>
      <input type="text" id="prenom" name="prenom" />
    </li>
    <li>
      <label for="telephone">Téléphone&nbsp;:</label>
      <input type="text" id="telephone" name="telephone" />
    </li>
    <li>
      <label for="mail">Mail&nbsp;:</label>
      <input type="text" id="mail" name="mail" />
    </li>
    <li>
      <label for="adresse">Adresse&nbsp;:</label>
      <input type="text" id="adresse" name="adresse" />
    </li>

  </ul>
  <input type="submit" value="Ajouter un étudiant">
</form>
<?php

if(isset($_POST['nom'])&& isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['mail'])){
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $telephone = $_POST['telephone'];
  $mail = $_POST['mail'];
  $adresse = $_POST['adresse'];

  $etudiant = new Etudiant($nom, $prenom, $telephone, $mail, $adresse);
  $etudiant->create();
  header('Location: index.php');
  exit();

}