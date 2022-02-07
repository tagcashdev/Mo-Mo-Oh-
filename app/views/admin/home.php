Home Admin
<?php

use Core\Auth\DatabaseAuth;

$app = App::getInstance();
$auth = new DatabaseAuth($app->getDb());

echo '<pre>'; print_r($auth->getSessionByIdUser()); echo '<pre>';
?>