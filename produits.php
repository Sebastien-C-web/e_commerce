<?php 

class Produits {

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


}