<?php
require "model/GamesModel.php";

    function searchGames()
    {
        if (isset($_POST['game'])) {
            $gameName = $_POST['game'];
            include "view/searchGames.php";
        } else {
            echo "RECHERCHE VIDE";
        }
    }

    function checkGame()
    {
        if (isset($_GET['game'])) {
            $gameSlug = $_GET['game'];
            $model = new GamesModel();
            $gameExist = $model->checkGame($gameSlug);
            if ($gameExist == true) {
                getGame($gameSlug);
            } else {
                $jsonData = file_get_contents("https://api.rawg.io/api/games/$gameSlug");
                $gameData = json_decode($jsonData, true);
                // var_dump($gameData['parent_platforms']);
                foreach ($gameData['parent_platforms'] as $platform) {
                    $platformSlug = $platform['platform']['slug'];
                    $platformName = $platform['platform']['name'];
                    $platformExist = $model->checkPlatform($platformSlug);
                    if ($platformExist == false) {
                        $model->addPlatform($platformSlug, $platformName);
                    };
                };
                $gameName = $gameData['name'];
                $gameImg = $gameData['background_image'];
                $gameDescription = $gameData['description'];
                $model->addGame($gameSlug, $gameName, $gameImg, $gameDescription);
                foreach ($gameData['parent_platforms'] as $platform) {
                    $platformSlug = $platform['platform']['slug'];
                    $platformId = $model->getPlatform($platformSlug);
                    $platformId = $platformId['id'];
                    var_dump($platformSlug);
                    var_dump($platformId);
                    $gameId = $model->getGame($gameSlug);
                    $gameId = $gameId['gameId'];
                    $model->addGamePlatform($gameId, $platformId);
                }
                getGame($gameSlug);
            }
        } else {
            include "view/homepage.php";
        }
    }

    function getGame($gameSlug)
    {
        $model = new GamesModel();
        $gameData = $model->getGame($gameSlug);
        $gameId = $gameData['gameId'];
        $noteData = $model->getNote($gameId);
        $commentsData = $model->getComments($gameId);
        include "view/getGame.php";
    }


    function noteGame()
    {
        if (isset($_GET['gameId'])) {
            $gameId = $_GET['gameId'];
            $gameSlug= $_POST['gameSlug'];
            $noteGraphismes = $_POST['noteGraphismes'];
            $noteGameplay = $_POST['noteGameplay'];
            $noteAmbiance = $_POST['noteAmbiance'];
            $notePerso = $_POST['notePerso'];
            $noteTotale = $noteGraphismes + $noteGameplay + $noteAmbiance + $notePerso;
            $userId = $_POST['userId'];
            $model = new GamesModel();
            $model->noteGame($gameId, $noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId);
            header("Location: http://localhost/projet5/index.php?action=getGame&game=$gameSlug");
        }
    }

    function addComment()
    {
        if (isset($_POST['gameId']) && isset($_SESSION['pseudo'])) {
            $pseudo = $_SESSION['pseudo'];
            $userId = $_SESSION['userId'];
            $commentaire = $_POST['commentaire'];
            $gameId = $_POST['gameId'];
            $gameSlug = $_POST['gameSlug'];
            $model = new GamesModel();
            $model->addComment($pseudo, $userId, $gameId, $commentaire);
            header("Location: http://localhost/projet5/index.php?action=getGame&game=$gameSlug");
        }
    }


    function getTopGames()
    {

    }


    // penser a integrer la lib 
