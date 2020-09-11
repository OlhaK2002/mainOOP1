<?php

class VerificationA extends Authorization
{
    protected $sql;
    protected $array;
    protected $hash;
    protected $password_verification;

    public function Evidence()
    {
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `login`= :login LIMIT 1");
        $this->sql->bindParam(':login',$this->login,PDO::PARAM_STR);
        $this->sql->execute();

        $this->array = $this->sql->FETCH(PDO::FETCH_ASSOC);
        $this->hash = $this->array['password1'];
        $this->password_verification = password_verify($this->password,$this->hash);

        return $this->password_verification;
    }

}