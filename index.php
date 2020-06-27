<?php session_start();
$action = $_GET["action"];

if ($action=="accueil") {
    include "view/homepage.php";
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

if ($action=="top") {
    getTopGames();
}

if ($action=="populaires") {
    getPopularGames();
}

if ($action=="adminPanel"){
    getAdminPanel();
}

if($action=="reportComment"){
    reportComment();
}

if($action=="deleteComment"){
    deleteComment();
}

if($action=="approveComment"){
    approveComment();
}
