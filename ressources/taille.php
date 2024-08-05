<?php 
require_once('./config/db.php');

class Taille extends db {

    private $taille;
    
    private $produitID;

    public function setTaille($taille){
        $this->taille = $taille;
    }

    public function getTaille(): string
    {
        return $this->taille;
    }

    public function setProduitID($produitID){
        $this->produitID = $produitID;
    }

    public function getProduitID(): int 
    {
        return $this->produitID;
    }

    public function getAllTaille()
    {
        $sql = "SELECT * FROM taille";
        $done = $this->connecte()->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

}