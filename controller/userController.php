<?php
require "model/UserModel.php";

    function saveInscription()
    {
        $model = new UserModel();
        $model->createUser($_POST['pseudo'], $_POST['password']);
        include "view/homepage.php";
    }

    function login()
    {
        $model = new UserModel();
        $model->logInUser($_POST['pseudo'], $_POST['password']);
        include "view/homepage.php";
    }

    function deconnexion()
    {
        session_destroy();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
