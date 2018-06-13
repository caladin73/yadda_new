<?php
    session_start();
    require_once './controller/Controller.inc.php'; // domainmodel

    $controller = new Controller($_GET, $_POST, $_FILES);
    $controller->action();
?>