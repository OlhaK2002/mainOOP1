<?php
class HashPassword extends VerificationR
{
    protected $password;


    public function hash()
    {
        $this->password = password_hash($this->password1, PASSWORD_DEFAULT);
        return $this->password;
    }
}