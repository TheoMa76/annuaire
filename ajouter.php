<?php

require_once './configs/bootstrap.php';
require_once './src/crud.php';
require_once './src/Entity/Etudiant.php';
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

<form action="ajouter.php" method="post">
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
  create($etudiant);
  header('Location: index.php?page=accueil');
  exit();

}