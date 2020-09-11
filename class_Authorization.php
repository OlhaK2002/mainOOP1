<?php
class Authorization
{
    protected $login;
    protected $password;
    protected $db;

    public function __construct($db, $login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->db = $db;
    }
}