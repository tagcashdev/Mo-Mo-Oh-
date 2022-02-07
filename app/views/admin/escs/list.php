<?php $app = App::getInstance(); ?>

<h1>Manages Animes</h1>

<a href="?p=admin.escs.add" class="btn btn-outline-primary">Add new Anime</a>

<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>COVER</td>
            <td>TITLE</td>
            <td>CATEGORIES</td>
            <td>ACTIONS</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($escs as $esc) : ?>

            <tr>
                <td><?= $esc->id_escs; ?></td>
                <td><img src="./cover/<?= (empty($esc->escs_cover) ? 'default.jpg' : $esc->escs_cover) ?>" class="img-fluid cover-anime-miniature rounded" alt="<?= $esc->escs_title ?>"></td>
                <td><?= $esc->escs_title; ?></td>
                <td>
                    <?php foreach ($esc->escs_categories as $categories) { ?>
                        <span class="badge <?= ($app->darkorlight($categories->categories_color) == 1 ? 'text-dark' : '') ?>" style="background-color:<?= $categories->categories_color ?>"><?= $categories->categories_title ?></span>
                    <?php } ?>
                </td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.escs.edit&id=<?= $esc->id_escs ?>">Editer</a>
                    <form method="post" action="?p=admin.escs.delete" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $esc->id_escs ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>