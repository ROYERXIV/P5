<?php
require "model/UserModel.php";

    function saveInscription(){
        $model = new UserModel();
        $model->createUser($_POST['pseudo'], $_POST['password']);
    }