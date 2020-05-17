<?php session_start();
$action = $_GET["action"];

if($action=="accueil"){
    include "view/homepage.php";
}
require "controller/userController.php";

if($action=="saveInscription"){
    saveInscription();
}

if($action=="login"){
    login();
}

if($action=="deconnexion"){
    deconnexion();
}


if($action=="testTemplate"){
    include "view/template.php";
}
