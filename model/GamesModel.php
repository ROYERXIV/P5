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
            $requete = $bdd->prepare(" SELECT gameslug FROM games WHERE gameslug = ? ");
            $requete->execute([htmlspecialchars($gameName)]);
            $result = $requete->fetch();
            return $result;
        }

        public function noteGame($gameName,$noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO notes (gameslug, noteGraphismes, noteGameplay, noteAmbiance, notePerso, noteTotale, userId) VALUES (?,?,?,?,?,?,?)");
            $requete->execute([$gameName,$noteGraphismes, $noteGameplay, $noteAmbiance, $notePerso, $noteTotale, $userId]);
        }

        public function getNote($gameName)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("SELECT avg(noteGraphismes) as moyGraphismes, avg(noteGameplay) as moyGameplay, avg(noteAmbiance) as moyAmbiance, avg(notePerso) as moyPerso, avg(noteTotale) as moyTotale, userId FROM notes WHERE gameslug = ?");
            $requete->execute([$gameName]);
            return $requete->fetch();
        }

        public function addComment($userId, $gameName,$commentaire)
        {
            $bdd = $this->dbConnect();
            $requete = $bdd->prepare("INSERT INTO commentaires (pseudo, gameslug, content) VALUES (?,?,?)");
            $requete->execute([$userId,$gameName,$commentaire]);              
        }
    }