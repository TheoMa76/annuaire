<?php
require_once './configs/bootstrap.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    list($etudiants, $ids) = rechercher($search);
} else {
    global $connection;
    $data = $connection->query(queryBuilder('r', 'etudiant'));

    $etudiants = [];
    foreach ($data as $row) {
        $etudiant = new Etudiant($row["nom"], $row["prenom"], $row["telephone"], $row["mail"], $row["adresse"]);
        $ids[] = $row["id"];
        $etudiants[] = $etudiant;
    }
}

function rechercher($search)
{
    global $connection;

    $query = "SELECT * FROM etudiant 
              WHERE nom LIKE :search 
              OR prenom LIKE :search 
              OR telephone LIKE :search 
              OR mail LIKE :search 
              OR adresse LIKE :search";

    $stmt = $connection->prepare($query);

    $searchParam = '%' . $search . '%';
    $stmt->bindParam(':search', $searchParam);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $etudiants = [];
    $ids = [];
    foreach ($results as $row) {
        $etudiant = new Etudiant($row["nom"], $row["prenom"], $row["telephone"], $row["mail"], $row["adresse"]);
        $ids[] = $row["id"];
        $etudiants[] = $etudiant;
    }
    return array($etudiants, $ids);
}
?>

<div class="recherche">
    <form method="GET" action="">
        <input type="text" name="search" id="search" placeholder="Rechercher...">
    </form>
</div>
<a href="ajouter.php" class="action-button ajouter-button">Ajouter un étudiant</a>
<div class="listUser">
    <ul>
        <table id="etudiants-table">
            <tr>
                <th id="nom-column" class="action-header">Nom</th>
                <th id="prenom-column" class="action-header">Prénom</th>
                <th id="telephone-column" class="action-header">Téléphone</th>
                <th id="mail-column" class="action-header">Mail</th>
                <th id="adresse-column" class="action-header">Adresse</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach ($etudiants as $index => $etudiant) {
                ?>
                <tr>
                    <td><?= $etudiant->getNom()?></td>
                    <td><?= $etudiant->getPrenom()?></td>
                    <td><?= $etudiant->getTelephone()?></td>
                    <td><?= $etudiant->getMail()?></td>
                    <td><?= $etudiant->getAdresse()?></td>
                    <td>
                        <a href="editer.php?id=<?= $ids[$index] ?>" class="action-button editer-button">Editer</a>
                        <div class='supprimer'>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $ids[$index] ?>">
                                <button type="submit" name="submit" class="action-button supprimer-button" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php
             if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $id = $_POST['id'];
                delete($etudiant, $id);
                header('Location: index.php?page=accueil');
                exit();
            }
            }
            ?>
        </table>
    </ul>
</div>
<?php
include_once './templates/includes/html_footer.inc.php';
?>
<script>
    var timeout = null;
    var searchInput = document.getElementById('search');
    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            var searchValue = searchInput.value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    var tempElement = document.createElement('div');
                    tempElement.innerHTML = this.responseText; 

                    var etudiantsTableContent = tempElement.querySelector('#etudiants-table').innerHTML;

                    document.getElementById('etudiants-table').innerHTML = etudiantsTableContent;
                }
            };
            xhttp.open("GET", "index.php?search=" + searchValue, true);
            xhttp.send();
        }, 500);
    });
</script>
