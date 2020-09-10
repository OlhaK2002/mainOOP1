<?php

class DB
{
    public $link;

    public function Connect()
    {
        $this->link = new PDO('mysql:host=localhost;dbname=guest_book', 'root', 'root');

    }

    public function getConnect()
    {
        return $this->link;
    }

}


