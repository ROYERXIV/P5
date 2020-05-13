<?php
require_once "model/DbModel.php";

    class UserModel extends DbModel {

        public function createUser($pseudo, $password){
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO users (pseudo,password) VALUES (?,?)");
            $requete->execute([htmlspecialchars($pseudo), password_hash($password, PASSWORD_DEFAULT)]);
        }
    }