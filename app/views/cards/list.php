<?php $app = App::getInstance(); ?>

<div class="my-3">
    <div class="container">
        <div class="row g-3">
            <?php foreach ($cards as $card) :

                $color = "black";
                if($card->cards_tcg_release < $card->cards_ocg_release){
                    $color = "green";
                }else{
                    if($card->year_diff_tcg_ocg >= 2){ $color = "red"; }
                }

                ?>
            <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img src="<?= $card->image_url ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">
                        <span></span>
                        <?= '<span style="color:'.$color.'">'.$card->date_diff_tcg_ocg.'</span>' ?>
                    </p>
                </div>
            </div>
            </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>