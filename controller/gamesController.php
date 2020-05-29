<?php
require "model/GamesModel.php";

    function searchGames(){
        if(isset($_POST['game'])){
            $gameName = $_POST['game'];
            include "view/searchGames.php";
        } else {
            echo "RECHERCHE VIDE";
        }
    }

    function checkGame(){
        if(isset($_GET['game'])){
            $gameName = $_GET['game'];
            $model = new GamesModel();
            $gameExist = $model->checkGame($gameName);
            if($gameExist == true){
                getGame($gameName);
            } else {
                $model->addGame($gameName);
                getGame($gameName);
            } 
        }
        else{
            include "view/homepage.php";
        }        
    }

    function getGame($gameName){
        $model = new GamesModel();
        $gameSlug = $model->getGame($gameName);
        $noteData = $model->getNote($gameName);
        // var_dump($noteData);
        include "view/getGame.php";
    }

    function noteGame(){
        if(isset($_GET['game'])){
            $gameName = $_GET['game'];
            $noteGraphismes = $_POST['noteGraphismes'];
            $noteGameplay = $_POST['noteGameplay'];
            $noteAmbiance = $_POST['noteAmbiance'];
            $notePerso = $_POST['notePerso'];
            $noteTotale = $noteGraphismes + $noteGameplay + $noteAmbiance + $notePerso;
            $userId = $_POST['userId'];
            $model = new GamesModel();
            $model->noteGame($gameName, $noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId);
        }
    }

    function addComment(){
        if(isset($_POST['game']) && isset($_SESSION['pseudo'])){
            $userId = $_SESSION['pseudo'];
            $commentaire = $_POST['commentaire'];
            $gameName = $_POST['game'];
            $model = new GamesModel();
            $model->addComment($userId,$gameName,$commentaire);
            header("Location: http://localhost/projet5/index.php?action=getGame&game=$gameName"); 

        }
    }
    
