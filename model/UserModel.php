<?php
require_once "model/DbModel.php";

    class UserModel extends DbModel {

        public function createUser($pseudo, $password){
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" INSERT INTO users (pseudo,password) VALUES (?,?)");
            $requete->execute([htmlspecialchars($pseudo), password_hash($password, PASSWORD_DEFAULT)]);
        }

        public function logInUser($pseudo, $password){
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" SELECT pseudo, password as hash FROM users where pseudo = ? ");
            $requete->execute([htmlspecialchars($pseudo)]);
            $results = $requete->fetch();
            $hash = $results['hash'];
            if (password_verify($password, $hash)) {
                $_SESSION['pseudo'] = $pseudo;
            } else {
                echo " Identifiants incorrects";
            }
        }
    }