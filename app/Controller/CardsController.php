<?php

namespace App\Controller;

use App;

class CardsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('cards');
    }

    public function index()
    {
        $cards = $this->cards->getAll();
        $this->render('cards.index', compact('cards'));
    }

    public function list()
    {
        $cards = $this->cards->getAllCards();
        $this->render('cards.list', compact('cards'));
    }


    public function detail()
    {
        $card = $this->cards->getCard(1);
        $this->render('cards.detail', compact('card'));
    }
}
