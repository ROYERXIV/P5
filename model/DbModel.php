<?php

class DbModel
{
    protected function dbConnect()
    {
        try {
            $bdd = new PDO('mysql:host=localhost;port=3308;dbname=projet5;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}