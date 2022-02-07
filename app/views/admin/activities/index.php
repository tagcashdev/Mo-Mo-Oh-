<?php
$activities = App::getInstance()->getTable('Activity')->getAll();
?>

<h1>Administrer les activités</h1>

<a href="?p=admin.activities.add" class="btn btn-outline-primary">Ajouter une activité</a>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nom</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($activities as $activity) : ?>
            <tr>
                <td><?= $activity->id_activities; ?></td>
                <td><?= $activity->activities_name; ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.activities.edit&id=<?= $activity->id_activities ?>">Editer</a>
                    <form method="post" action="?p=admin.activities.delete" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $activity->id_activities ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>