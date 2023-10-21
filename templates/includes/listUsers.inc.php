<ul>
    <table>
        <tr>
        <th id="nom-column" class="action-header">Nom</th>
        <th id="prenom-column" class="action-header">Prénom</th>
        <th id="telephone-column" class="action-header">Téléphone</th>
        <th id="mail-column" class="action-header">Mail</th>
        <th id="adresse-column" class="action-header">Adresse</th>
            <th>Actions</th>
        </tr>
        <?php 
        require_once './src/crud.php';
        $data = $connection->query(queryBuilder('r', 'etudiant'));

        $etudiants = [];
        foreach ($data as $row) {
            $etudiant = new Etudiant($row["nom"], $row["prenom"], $row["telephone"], $row["mail"], $row["adresse"]);
            $ids[] = $row["id"];
            $etudiants[] = $etudiant;
        }
        ?>

        <form method="get" action="">
                <input type="text" name="search" placeholder="Rechercher...">
                <input type="submit" value="Rechercher">
            </form>

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
                    <form method="post" action="">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $ids[$index] ?>">
                        <button type="submit" name="submit" class="action-button supprimer-button" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php
        }

        if (isset($_POST['action']) && $_POST['action'] === 'delete') {
            $id = $_POST['id'];
            delete($etudiant, $id);
            header('Location: index.php?page=accueil');
            exit();
        }

        ?>
    </table>
</ul>