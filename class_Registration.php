<?php
class Registration
{
    protected $name;
    protected $surname;
    protected $email;
    protected $login;
    protected $password1;
    protected $password2;
    protected $db;

    public function __construct($db, $name, $surname, $email, $login, $password1, $password2)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->login = $login;
        $this->password1 = $password1;
        $this->password2 = $password2;
        $this->db = $db;

    }
}