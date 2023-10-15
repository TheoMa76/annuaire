<style>
    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #f9f9f9;
        margin: 0.5em 0;
        padding: 1em;
        border-radius: 5px;
    }

    h4, h5 {
        margin: 0.5em 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
    }
</style>

<ul>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Mail</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
        <?php 
        require_once './src/crud.php';
        $data = $connection->query(queryBuilder('r', 'etudiant'));
        foreach ($data as $key => $value) {
            ?>
            <tr>
                <td><?= $value["nom"]?></td>
                <td><?= $value["prenom"]?></td>
                <td><?= $value["telephone"]?></td>
                <td><?= $value["mail"]?></td>
                <td><?= $value["adresse"]?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</ul>
