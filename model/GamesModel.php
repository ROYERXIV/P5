<?php
require_once "model/DbModel.php";

    class GamesModel extends DbModel
    {
        public function checkGame($gameName)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" SELECT gameslug FROM games WHERE gameslug = ? ");
            $requete->execute([htmlspecialchars($gameName)]);
            $result = $requete->fetch();
            if ($result['gameslug'] == $gameName) {
                return true;
            } else {
                return false;
            }
        }

        public function addGame($gameSlug, $gameName, $gameImg, $gameDescription)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" INSERT INTO games (gameslug, gameName, gameImg, gameDescription) VALUES (?,?,?,?) ");
            $requete->execute([htmlspecialchars($gameSlug),$gameName,$gameImg,$gameDescription]);
        }

        public function getGame($gameName)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" SELECT * FROM games WHERE gameslug = ? ");
            $requete->execute([htmlspecialchars($gameName)]);
            $result = $requete->fetch();
            return $result;
        }

        public function noteGame($gameId, $noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO notes (gameId, noteGraphismes, noteGameplay, noteAmbiance, notePerso, noteTotale, userId) VALUES (?,?,?,?,?,?,?)");
            $requete->execute([$gameId,$noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId]);
        }

        public function getNote($gameId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT avg(noteGraphismes) as moyGraphismes, avg(noteGameplay) as moyGameplay, avg(noteAmbiance) as moyAmbiance, avg(notePerso) as moyPerso, avg(noteTotale) as moyTotale, userId FROM notes WHERE gameId = ?");
            $requete->execute([$gameId]);
            return $requete->fetch();
        }

        public function addComment($pseudo, $userId, $gameId, $commentaire)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO commentaires (pseudo, userId, gameId, content) VALUES (?,?,?,?)");
            $requete->execute([$pseudo,$userId,$gameId,$commentaire]);
        }

        public function getComments($gameId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT * FROM commentaires WHERE gameId = ?");
            $requete->execute([$gameId]);
            return $requete;
        }

        public function checkPlatform($platformSlug)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT slug FROM plateformes WHERE slug = ?");
            $requete->execute([$platformSlug]);
            $result = $requete->fetch();
            if ($result['slug'] == $platformSlug) {
                return true;
            } else {
                return false;
            }
        }

        public function addPlatform($platformSlug, $platformName)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO plateformes (slug, platformName) VALUES (?,?)");
            $requete->execute([$platformSlug, $platformName]);
        }

        public function getPlatform($platformSlug)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT id FROM plateformes WHERE slug = ?");
            $requete->execute([$platformSlug]);
            return $requete->fetch();
        }

        public function addGamePlatform($gameId, $platformId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO game_platform (idGame,idPlatform) VALUES (?,?)");
            $requete->execute([$gameId,$platformId]);
        }

        public function getTopGames($page)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT g.*, avg(noteGraphismes+noteGameplay+noteAmbiance+notePerso) as note FROM games AS g INNER JOIN notes AS n ON g.gameId = n.gameId group by g.gameId ORDER BY noteTotale DESC LIMIT ?,10");
            $requete->execute([$page*10]);
            $result = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as &$game){
                $requete2 = $bdd->prepare("SELECT * FROM plateformes p INNER JOIN game_platform gp ON p.id=gp.idPlatform WHERE idGame=?");
                $requete2->execute([$game["gameId"]]);
                $game['plateformes']=$requete2->fetchAll(PDO::FETCH_ASSOC);
                $game['gameDescription'] = strip_tags($game['gameDescription']);
            }
            return json_encode($result);
        }
        
        public function getPopularGames()
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT g.*, (SELECT count(*) FROM commentaires WHERE gameId=g.gameId) AS nbcom FROM games g ORDER BY nbcom DESC");
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as &$game){
                $requete2 = $bdd->prepare("SELECT * FROM plateformes p INNER JOIN game_platform gp ON p.id=gp.idPlatform WHERE idGame=?");
                $requete2->execute([$game["gameId"]]);
                $game['plateformes']=$requete2->fetchAll(PDO::FETCH_ASSOC);
                $game['gameDescription'] = strip_tags($game['gameDescription']);
            }
            return json_encode($result);
        }

        public function reportComment($commentId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("UPDATE commentaires SET isReported = 1 WHERE commentId = ?");
            $requete->execute([$commentId]);
        }
    
        public function getReportedComments()
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->query("SELECT * FROM commentaires WHERE isReported = 1");
            return $requete;
        }
    
        public function approveComment($commentId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("UPDATE commentaires SET isReported = 0 WHERE commentId = ?");
            $requete->execute([$commentId]);
        }
    
        public function deleteComment($commentId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("DELETE FROM commentaires WHERE commentId = ?");
            $requete->execute([$commentId]);
        }    
    }


        