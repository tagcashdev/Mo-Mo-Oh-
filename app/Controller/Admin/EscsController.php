<?php

namespace App\Controller\Admin;

use App;
use Core\HTML\BootstrapForm;

class EscsController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('cards');
    }

    public function list()
    {
        if (!empty($_POST['search'])) {
            $escs = $this->escs->getSearched($_POST['search']);
        }else{
            $start = (isset($_GET['start']) ? $_GET['start'] : null);
            $escs = $this->escs->getAllLike($start, "0, 9999");
        }

        foreach ($escs as $ei => $esc) {
            $escs_categories = $this->escs->getAllCategoriesPerEscs($escs[$ei]->id_escs, true);
            $escs[$ei]->{'escs_categories'} = $escs_categories;
        }

        //$genders = $this->cards->getAllCategories();
        //$statutes = $this->cards->getAllStatutes();

        $this->render('admin.cards.list', compact('escs'));
    }

    public function add()
    {
        if (!empty($_POST)) {

            $LastInsertId = $this->escs->create([
                'escs_title' => $_POST['escs_title'],
                'escs_description' => $_POST['escs_description'],
                'escs_episodes' => $_POST['escs_episodes'],
                'escs_seen' => $_POST['escs_seen'],
                'escs_year' => $_POST['escs_year'],
                'escs_author' => $_POST['escs_author'],
                'escs_studios' => $_POST['escs_studios'],
                'escs_youtube' => $_POST['escs_youtube'],
                'idx_statutes' => $_POST['idx_statutes'],
                'idx_types' => $_POST['idx_types']
            ], false, true);

            if (!empty($_FILES["escs_cover"]["name"])) {
                $upload = 1;

                $target_dir = "/home/u978558320/domains/animelist.online/public_html/public/cover/";
                $target_file = $target_dir . basename($_FILES["escs_cover"]["name"]);

                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["escs_cover"]["tmp_name"]);

                if ($check !== false) {
                    $alert = ['message' => "File is an image - " . $check["mime"] . ".", 'type' => 'succes'];
                } else {
                    $alert = ['message' => "File is not an image.", 'type' => 'error'];
                    $upload = 0;
                }

                if ($upload == 0) {
                    $alert = ['message' =>  "Sorry, your file was not uploaded.", 'type' => 'error'];
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["escs_cover"]["tmp_name"], $target_file)) {
                        $alert = ['message' => "The file " . htmlspecialchars(basename($_FILES["escs_cover"]["name"])) . " has been uploaded.", 'type' => 'succes'];

                        $upload = $this->escs->update([
                            'name' => 'id_escs',
                            'value' => $LastInsertId
                        ], [
                            'escs_cover' => $_FILES["escs_cover"]["name"]
                        ]);
                    } else {
                        $alert = ['message' => "Sorry, there was an error uploading your file.", 'type' => 'error'];
                    }
                }
            }

            $this->escs->InsertCategoriesById($LastInsertId, $_POST['escs_categories']);

            header('Location: index.php?p=admin.cards.edit&id='.$LastInsertId);
        }
        
        $genders = $this->escs->getAllCategories();
        $statutes = $this->escs->getAllStatutes();
        $types = $this->escs->getAllTypes();

        $form = new BootstrapForm();

        $this->render('admin.cards.edit', compact('form', 'genders', 'statutes', 'types'));
    }

    public function edit()
    {
        $alert = [];
        if (!empty($_POST)) {

            $result = $this->escs->update([
                'name' => 'id_escs',
                'value' => $_GET['id']
            ], [
                'escs_title' => $_POST['escs_title'],
                'escs_description' => $_POST['escs_description'],
                'escs_episodes' => $_POST['escs_episodes'],
                'escs_seen' => $_POST['escs_seen'],
                'escs_year' => $_POST['escs_year'],
                'escs_author' => $_POST['escs_author'],
                'escs_studios' => $_POST['escs_studios'],
                'escs_youtube' => $_POST['escs_youtube'],
                'idx_statutes' => $_POST['idx_statutes'],
                'idx_types' => $_POST['idx_types']
            ]);

            // upload cover
            if (!empty($_FILES["escs_cover"]["name"])) {
                $upload = 1;
                $target_dir = "/home/u978558320/domains/animelist.online/public_html/public/cover/";
                $target_file = $target_dir . basename($_FILES["escs_cover"]["name"]);

                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["escs_cover"]["tmp_name"]);

                if ($check !== false) {
                    $alert = ['message' => "File is an image - " . $check["mime"] . ".", 'type' => 'succes'];
                } else {
                    $alert = ['message' => "File is not an image.", 'type' => 'error'];
                    $upload = 0;
                }

                if ($upload == 0) {
                    $alert = ['message' =>  "Sorry, your file was not uploaded.", 'type' => 'error'];
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["escs_cover"]["tmp_name"], $target_file)) {
                        $alert = ['message' => "The file " . htmlspecialchars(basename($_FILES["escs_cover"]["name"])) . " has been uploaded.", 'type' => 'succes'];

                        $upload = $this->escs->update([
                            'name' => 'id_escs',
                            'value' => $_GET['id']
                        ], [
                            'escs_cover' => $_FILES["escs_cover"]["name"]
                        ]);
                    } else {
                        $alert = ['message' => "Sorry, there was an error uploading your file.", 'type' => 'error'];
                    }
                }
            }

            //update categories
            $d = $this->escs->deleteAllCategoriesById($_GET['id']);
            $this->escs->InsertCategoriesById($_GET['id'], $_POST['escs_categories']);

            if ($result) {
                return $this->list();
            }
        }

        $esc = $this->escs->getEsc($_GET['id']);

        $obj_esc_categories = $this->escs->getAllCategoriesPerEscs($esc->id_escs, true, 'id_categories');
        $esc_categories = array();
        foreach($obj_esc_categories as $esc_category){
            array_push($esc_categories, $esc_category->id_categories);
        }
        $esc->{'escs_categories'} = $esc_categories;

        $form = new BootstrapForm($esc);

        $genders = $this->escs->getAllCategories();
        $statutes = $this->escs->getAllStatutes();
        $types = $this->escs->getAllTypes();

        $this->render('admin.cards.edit', compact('esc', 'form', 'genders', 'statutes', 'types'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->escs->delete([
                'name' => 'id_escs',
                'value' => $_POST['id']
            ]);
            return $this->list();
        }
    }
}
