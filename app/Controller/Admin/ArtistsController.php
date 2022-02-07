<?php

namespace App\Controller\Admin;

use App;
use Core\HTML\BootstrapForm;

class ArtistsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Artist');
    }

    public function index()
    {
        $artists = $this->Artist->getAll();
        $this->render('admin.artists.index', compact('artists'));
    }

    public function add()
    {
        if (!empty($_POST)) {

            $result = $this->Artist->create([
                'artists_name' => $_POST['artists_name'],
                'artists_birthDate' => $_POST['artists_birthDate'],
                'idx_nationalities' => $_POST['idx_nationalities']
            ]);

            if ($result) {
                return $this->index();
            }
        }

        $this->loadModel('Nationality');
        $nationalities = $this->Nationality->getList('id_nationalities', 'nationalities_name_fr');

        $form = new BootstrapForm($_POST);

        $artists = $this->Artist->getAll();
        $this->render('admin.artists.edit', compact('artists', 'form', 'nationalities'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->Artist->update([
                'name' => 'id_artists',
                'value' => $_GET['id']
            ], [
                'artists_name' => $_POST['artists_name'],
                'artists_birthDate' => $_POST['artists_birthDate'],
                'idx_nationalities' => $_POST['idx_nationalities']
            ]);

            if ($result) {
                return $this->index();
            }
        }

        $this->loadModel('Nationality');
        $nationalities = $this->Nationality->getList('id_nationalities', 'nationalities_name_fr');

        $artist = $this->Artist->getArtist($_GET['id']);
        $form = new BootstrapForm($artist);

        $artists = $this->Artist->getAll();
        $this->render('admin.artists.edit', compact('artists', 'form', 'nationalities'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->Artist->delete([
                'name' => 'id_artists',
                'value' => $_POST['id']
            ]);
            return $this->index();
        }
    }
}
