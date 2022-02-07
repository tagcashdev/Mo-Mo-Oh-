<div class="container">
    <form method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-8">
            <?= $form->input('escs_title', 'Nom de l\'anime'); ?>
            <?= $form->textarea('escs_description', 'Description'); ?>
            <?= $form->input('escs_episodes', 'Nombre total d\'épisodes'); ?>
            <?= $form->input('escs_seen', 'Nombre d\'épisodes visionner'); ?>
            <?= $form->input('escs_year', 'Année de production', ['type' => 'year']); ?>
            <?= $form->input('escs_author', 'Auteurs'); ?>
            <?= $form->input('escs_studios', 'Studios'); ?>
            <?= $form->input('escs_youtube', 'Lien Youtube'); ?>
        </div>

        <div class="col-4">
            <div class="form-group">
                <img src="./cover/<?= (empty($esc->escs_cover) ? 'default.jpg' : $esc->escs_cover) ?>" class="img-fluid cover-anime rounded" alt="<?= $esc->escs_title ?>">
            </div>
            <?= $form->input('escs_cover', 'Cover', ['type' => 'file', 'id' => 'fileUpload']); ?>
            <?php 
                $idx_statutes = array();
                foreach($statutes as $ss => $s){
                    $idx_statutes[$s->id_statutes] = $s->statutes_title;
                }
            ?>
            <?= $form->select('idx_statutes', 'Statuts', $idx_statutes); ?>
            <?php 
                $idx_types = array();
                foreach($types as $ts => $t){
                    $idx_types[$t->id_types] = $t->types_title;
                }
            ?>
            <?= $form->select('idx_types', 'Types', $idx_types); ?>
        </div>

        <div class="col-12">
            <div style="display:flex;">
                <?php
                $nbKind = 0;
                foreach ($genders as $kind) {
                    if ($nbKind % 5 == 0) {
                        if ($nbKind != 0) {
                            echo '</div>';
                        }
                        echo '<div class="col list-group pb-2 pe-2">';
                    }
                ?>

                    <label class="list-group-item">
                        <input class="form-check-input me-1" name="escs_categories[]" type="checkbox" <?= (in_array($kind->id_categories, (isset($esc->escs_categories) ? $esc->escs_categories : [0])) ? 'checked' : '') ?> value="<?= $kind->id_categories ?>">
                        <?= $kind->categories_title ?>
                    </label>

                <?php
                    $nbKind++;
                }
                echo '</div>';
                ?>
            </div>
        </div>

        <button class="btn btn-primary">Sauvegarder</button>
    </form>
</div>