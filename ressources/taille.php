<?php 
require_once('./config/db.php');

class Taille extends db {

    private $taille;
    
    private $quantiteId;

    public function setTaille($taille){
        $this->taille = $taille;
    }

    public function getTaille(): string
    {
        return $this->taille;
    }

    public function setQuantiteID($quantiteId){
        $this->quantiteId = $quantiteId;
    }

    public function getQuantiteID(): int 
    {
        return $this->quantiteId;
    }

    public function getAllTaille()
    {
        $sql = "SELECT * FROM taille";
        $done = $this->connecte()->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

}