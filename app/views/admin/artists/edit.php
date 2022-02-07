<form method="post">
    <?= $form->input('artists_name', 'Nom de l\'artiste'); ?>
    <?= $form->input('artists_birthDate', 'Date de naissance', ['type' => 'date']); ?>
    <?= $form->select('idx_nationalities', 'Nationalité', $nationalities); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>