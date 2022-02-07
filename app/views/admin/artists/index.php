<h1>Administrer les artistes</h1>

<a href="?p=admin.artists.add" class="btn btn-outline-primary">Ajouter un artiste</a>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
            <td>Date de naissance</td>
            <td>Date de décès</td>
            <td>Nationnalité</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($artists as $artist) : ?>
            <tr>
                <td><?= $artist->id_artists; ?></td>
                <td><?= $artist->artists_name; ?></td>
                <td><?= $artist->artists_birthDate; ?></td>
                <td><?= $artist->artists_deathDate; ?></td>
                <td><?= $artist->idx_nationalities; ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.artists.edit&id=<?= $artist->id_artists ?>">Editer</a>
                    <form method="post" action="?p=admin.artists.delete" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $artist->id_artists ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>