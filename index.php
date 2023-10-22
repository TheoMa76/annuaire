<?php

require_once './configs/bootstrap.php';
ob_start();

if(isset($_GET["page"])){
    fromInc($_GET['page']);
}

$pageContent = [
    "html" => ob_get_clean(),

];
    include "./templates/layout/html.layout.php";
    require_once "./templates/includes/listUsers.inc.php";
    include_once "./templates/includes/html_header.inc.php";
    include_once "./templates/includes/html_footer.inc.php";