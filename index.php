<?php session_start();
$action = $_GET["action"];

if ($action=="accueil") {
    include "view/homepage.php";
}

if ($action=="populaires") {
    include "view/populaires.php";
}

if ($action=="top") {
    include "view/top.php";
}
require "controller/userController.php";

if ($action=="saveInscription") {
    saveInscription();
}

if ($action=="login") {
    login();
}

if ($action=="deconnexion") {
    deconnexion();
}


if ($action=="testTemplate") {
    include "view/template.php";
}


require "controller/gamesController.php";

if ($action=="search") {
    searchGames();
}

if ($action=="getGame") {
    checkGame();
}

if ($action=="noteGame") {
    noteGame();
}

if ($action=="addComment") {
    addComment();
}
