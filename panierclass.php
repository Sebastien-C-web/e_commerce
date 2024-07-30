<?php

class panier extends db 
{

    private $produits_id;

    private $total;

    private $reduction_id;



public function __construct()
    {
        $this->db = new db();
    }

public function setProduitsid()

{

$this->produits_id=$produits_id;

}

public function getProduitsid()

{

return $this->produits_id;

}

public function setTotal()

{

$this->total=$total;

}

public function getTotal()

{

    return $this->$total;

}

public function setReductionid()

{

    $this->reduction_id=$reduction_id;

}

public function getReductionid()

{

    return $this->$reduction_id;

}

}