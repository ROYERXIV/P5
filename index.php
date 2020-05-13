<?php session_start();
$action = $_GET["action"];

require "model/UserModel.php";

if($action=="saveInscription"){
    saveInscription();
}