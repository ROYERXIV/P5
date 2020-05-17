<?php
require "model/UserModel.php";

    function saveInscription(){
        $model = new UserModel();
        $model->createUser($_POST['pseudo'], $_POST['password']);
    }

    function login(){
        $model = new UserModel();
        $model->logInUser($_POST['pseudo'],$_POST['password']);
    }

    function deconnexion(){
        session_destroy();
    }