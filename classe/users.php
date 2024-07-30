<?php
class Users{

private $name;
private $email;
private $password;
private $statut;


public function getName()
{
return $this->name;
}

public function setName($name)
{
$this->name= $name;

return $this;
}

public function getEmail()
{
return $this->email;
}


public function setEmail($email)
{
$this->email = $email;

return $this;
}


public function getPassword()
{
return $this->password;
}


public function setPassword($password)
{
$this->password = $password;

return $this;
}

public function getStatut()
{
return $this->statut;
}


public function setStatut($statut)
{
$this->statut = $statut;

return $this;
}
}