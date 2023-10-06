<?php

require_once './configs/bootstrap.php';
ob_start();

if(isset($_GET["page"])){
    fromInc($_GET['page']);
}

$pageContent = [
    "html" => ob_get_clean(),

];
if(isset($_GET["layout"])){
    include "./templates/layout/". $_GET["layout"] .".layout.php";

}else{
    include "./templates/layout/html.layout.php";

}