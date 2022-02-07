<?php $app = App::getInstance(); ?>

<div>
    <div class="container">
        <div class="row g-3">
            <?php foreach ($cards as $card) : ?>
                <div>
                    <?php
                    echo '<pre>'; print_r($card); echo '</pre>';

                    $cards_tcg = date_create($card->cards_tcg);
                    $cards_ocg = date_create($card->cards_ocg);
                    $tcg_ocg = date_diff($cards_tcg, $cards_ocg);
                    $y = $tcg_ocg->format("%y");

                    $color = "black";
                    if($cards_tcg < $cards_ocg){
                        $color = "green";
                    }else{
                        if($y >= 2){ $color = "red"; }
                    }

                     echo '<span style="color:'.$color.'">'.$tcg_ocg->format("%y Years %m Months %d Days").'</span>';
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>