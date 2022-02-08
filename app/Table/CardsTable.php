<?php

namespace App\Table;

use \Core\Table\Table;

class CardsTable extends Table
{

    protected $table = 'cards';

    public function getCard($id_cards)
    {
        return $this->q('SELECT * FROM cards WHERE id_cards = ?', [$id_cards], false);
    }

    public function getAllCards()
    {
        $sql = '
            SELECT * FROM `cards` 
            LEFT JOIN cards_types on id_cards_types = idx_cards_types
            LEFT JOIN card_attributes on id_card_attributes = idx_card_attributes
            LEFT JOIN card_subtypes on id_card_subtypes = idx_card_subtypes
            LEFT JOIN monsters_types on id_monsters_types = idx_monsters_types 
        ';

        $cards = $this->q($sql, false);

        foreach ($cards as $ci => $card) {
            // get data from api
            $url = 'https://db.ygoprodeck.com/api/v7/cardinfo.php?name='.urlencode($card->cards_title);

            $ch = curl_init();
            $options = array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_SSL_VERIFYPEER => 0,
            );
            curl_setopt_array($ch, $options );
            $data = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ( $httpCode != 200 ){
                echo "Return code is {$httpCode} \n"
                    .curl_error($ch);
            } else {
                $cards[$ci]->{'image_url'} = json_decode($data, true)['data']['0']['card_images']['0']['image_url'];
            }

            curl_close($ch);


            // calculate date_diff between TCG & OCG
            $tcg_ocg = date_diff(date_create($card->cards_tcg_release), date_create($card->cards_ocg_release));
            $cards[$ci]->{'year_diff_tcg_ocg'} = $tcg_ocg->format("%y");
            $cards[$ci]->{'date_diff_tcg_ocg'} = $tcg_ocg->format("%y Years %m Months %d Days");
        }


        return $cards;
    }
}
