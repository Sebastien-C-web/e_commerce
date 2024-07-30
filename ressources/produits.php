<?php 
require_once('./config/db.php');

class Produits extends db {

    private $name;
    
    private $description;

    private $image;

    private $prix;

    public function setName($name){
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setPrix($prix){
        $this->prix = $prix;
    }

    public function getPrix(): string
    {
        return $this->prix;
    }

    public function getAllProduits()
    {
        $sql = "SELECT * FROM produits";
        $done = $this->connecte()->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    
}