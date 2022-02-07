<?php

namespace App\Controller;

use App;
use Core\Auth\DatabaseAuth;
use Core\HTML\BootstrapForm;

class UsersController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadModel('cards');
        $artists = $this->escs->getAll();
        $this->render('cards.index', compact('cards'));
    }

    public function login()
    {
        $errors = false;

        $app = App::getInstance();
        $auth = new DatabaseAuth($app->getDb());


        if (!empty($_POST)) {
            if ($auth->login($_POST['users_login'], $_POST['users_password'])) {
                header('Location: index.php?p=admin.cards.list');
            } else {
                $errors = true;
            }
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form', 'errors'));
    }

    public function logout()
    {
        $app = App::getInstance();
        $auth = new DatabaseAuth($app->getDb());
        $auth->logout();

        header('Location: index.php?p=cards.list');
    }
}
