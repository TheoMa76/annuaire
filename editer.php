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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM etudiant WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $etudiantData = $statement->fetch(PDO::FETCH_ASSOC);

    $etudiant = new Etudiant(
        $etudiantData['nom'],
        $etudiantData['prenom'],
        $etudiantData['telephone'],
        $etudiantData['mail'],
        $etudiantData['adresse']
    );


} else {
    echo "Aucun ID d'étudiant spécifié.";
    exit();
}
?>
<div class="form-crud">
  <form action="editer.php<?php if(!empty($_SERVER['QUERY_STRING'])) { echo '?' . $_SERVER['QUERY_STRING']; } ?>" method="post">
    <ul>
      <li><input type="hidden" name="id" value="<?php echo $etudiantData['id']; ?>"></input></li>
      <li>
        <label for="nom">Nom&nbsp;:</label>
        <input type="text" id="nom" name="nom"  value="<?php echo $etudiant->getNom();?>" />
      </li>
      <li>
        <label for="prenom">Prénom&nbsp;:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $etudiant->getPrenom(); ?>"/>
      </li>
      <li>
        <label for="telephone" >Téléphone&nbsp;:</label>
        <input type="text" id="telephone" name="telephone" value="<?php echo $etudiant->getTelephone(); ?>"/>
      </li>
      <li>
        <label for="mail" >Mail&nbsp;:</label>
        <input type="text" id="mail" name="mail" value="<?php echo $etudiant->getMail(); ?>"/>
      </li>
      <li>
        <label for="adresse" >Adresse&nbsp;:</label>
        <input type="text" id="adresse" name="adresse" value="<?php echo $etudiant->getAdresse(); ?>"/>
      </li>

    </ul>
    <input type="submit" value="Éditer">
  </form>
<?php

if(isset($_POST['nom'])&& isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['mail'])){
  $etudiant->setNom($_POST['nom']);
  $etudiant->setPrenom($_POST['prenom']);
  $etudiant->setTelephone($_POST['telephone']);
  $etudiant->setMail($_POST['mail']);
  $etudiant->setAdresse($_POST['adresse']);


  update($etudiant, $id);
  header('Location: index.php?page=annuaire');
  exit();

}