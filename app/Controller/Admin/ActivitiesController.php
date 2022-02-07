<?php

namespace App\Controller\Admin;

use App;
use Core\HTML\BootstrapForm;

class ActivitiesController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Activity');
    }

    public function index()
    {
        $activities = $this->Activity->getAll();
        $this->render('admin.activities.index', compact('activities'));
    }

    public function add()
    {
        if (!empty($_POST)) {

            $result = $this->Activity->create([
                'activities_name' => $_POST['activities_name']
            ]);

            if ($result) {
                return $this->index();
            }
        }

        $form = new BootstrapForm($_POST);

        $activities = $this->Activity->getAll();
        $this->render('admin.activities.edit', compact('activities', 'form'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->Activity->update([
                'name' => 'id_activities',
                'value' => $_GET['id']
            ], [
                'activities_name' => $_POST['activities_name']
            ]);

            if ($result) {
                return $this->index();
            }
        }

        $artist = $this->Activity->getActivity($_GET['id']);
        $form = new BootstrapForm($artist);

        $activities = $this->Activity->getAll();
        $this->render('admin.activities.edit', compact('activities', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->Activity->delete([
                'name' => 'id_activities',
                'value' => $_POST['id']
            ]);
            return $this->index();
        }
    }
}
