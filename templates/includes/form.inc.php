<?php
require './src/dbConnect.php';
require './configs/global.php';
?>
<!--<form action="./index.php" method="post">-->
<form action="#" method="post">
  <ul>
    <li>
      <label for="name">Nom&nbsp;:</label>
      <input type="text" id="name" name="name" />
    </li>
    <li>
      <label for="surname">prenom&nbsp;:</label>
      <input type="text" id="surname" name="surname" />
    </li>

  </ul>
  <input type="submit" value="ajouter un pelo">
</form>
<?php
if(isset($_POST['name'])&& isset($_POST['surname'])){
    $connection->query(queryBuilder('c','contacts',['name'=>$_POST['name']],['surname'=>$_POST['surname']]));
}