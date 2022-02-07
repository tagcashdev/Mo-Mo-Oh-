<?php

namespace App\Table;

use \Core\Table\Table;

class NationalityTable extends Table
{

    protected $table = 'nationalities';

    public function getNationality()
    {
        return $this->q('SELECT * FROM nationalities', null, false);
    }
}
