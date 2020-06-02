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

        public function addGame($gameName)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" INSERT INTO games (gameslug) VALUES (?) ");
            $requete->execute([htmlspecialchars($gameName)]);
        }

        public function getGame($gameName)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare(" SELECT * FROM games WHERE gameslug = ? ");
            $requete->execute([htmlspecialchars($gameName)]);
            $result = $requete->fetch();
            return $result;
        }

        public function noteGame($gameId,$noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId)
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

        public function addComment($pseudo,$userId, $gameId,$commentaire)
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
    }