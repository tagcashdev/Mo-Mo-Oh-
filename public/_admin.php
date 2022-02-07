<?php

use Core\Auth\DatabaseAuth;

define('ROOT', dirname(__DIR__));

require ROOT.'/app/App.php';
App::load();

$app = App::getInstance();


$p = 'index';
if(isset($_GET['p'])){
    $p = $_GET['p'];
}

$auth = new DatabaseAuth($app->getDb());
if(!$auth->logged()){
    $app->forbidden();
}else{
    if($p === 'logout'){
        $auth->logout();
        header('Location: index.php');
    }
}

ob_start();

if($p === 'index'){
    require ROOT . '/app/views/admin/home.php';
}elseif($p === 'artists'){
    require ROOT . '/app/views/admin/artists/index.php';
}elseif($p === 'artists.edit'){
    require ROOT . '/app/views/admin/artists/edit.php';
}elseif($p === 'artists.add'){
    require ROOT . '/app/views/admin/artists/add.php';
}
elseif($p === 'artists.delete'){
    require ROOT . '/app/views/admin/artists/delete.php';
}

elseif($p === 'activities'){
    require ROOT . '/app/views/admin/activities/index.php';
}elseif($p === 'activities.edit'){
    require ROOT . '/app/views/admin/activities/edit.php';
}elseif($p === 'activities.add'){
    require ROOT . '/app/views/admin/activities/add.php';
}
elseif($p === 'activities.delete'){
    require ROOT . '/app/views/admin/activities/delete.php';
}

$content = ob_get_clean();
require ROOT. '/app/views/templates/default.php';