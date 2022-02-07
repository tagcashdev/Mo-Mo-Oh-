<?php $app = App::getInstance(); ?>

<div>
    <div class="container">
        <div class="row g-3">
            <?php foreach ($cards as $card) : ?>
                <div>
                    <?php
                    echo '<pre>'; print_r($card); echo '</pre>';

                    $color = "black";
                    if($card->cards_tcg_release < $card->cards_ocg_release){
                        $color = "green";
                    }else{
                        if($card->year_diff_tcg_ocg >= 2){ $color = "red"; }
                    }

                     echo '<span style="color:'.$color.'">'.$card->date_diff_tcg_ocg.'</span>';
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>