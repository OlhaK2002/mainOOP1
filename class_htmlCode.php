<?php

class htmlCode
{
    public function beginCode()
    {
        return '<html lang="ru">
                <head>
                    <meta charset="utf-8">
                    <title>Guest book</title>
                    <link rel="stylesheet" href="main.css">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
                    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
                    <script type="text/javascript" src="reply.js"></script>
                </head>
                <body>
                <header>
                    <span id="title1">Гостевая книга</span>
                    <div class="menu">
                        <nav>
                            <ul>
                                <li><a href="/">Главная</a></li>';
    }

    public function mainCode()
    {
        return '</ul>
        </nav>
    </div>
</header>
<hr>';
    }

    public function endCode()
    {
        return '</body></html>';
    }

}

class Reply
{
    protected $index;

    public function __construct($index)
    {
        $this->index = $index;
    }
    public function replyComment()
    {
        return '<div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading' . $this->index . '">
                    <h2 class="mb-0">
                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapse_' . $this->index . '" aria-controls="collapse_' . $this->index . '">
                      Ответить
                    </button>
                    </h2>
                </div>
                <div id="collapse_' . $this->index . '" class="collapse" aria-labelledby="heading' . $this->index . '" data-parent="#accordionExample">
                    <div class="card-body">
                          <textarea required name="text" id="text_id' . $this->index . '" class="form-control"></textarea></br>
                          <input type="hidden" id="parent_id' . $this->index . '" class="parent_id" name="parent_id" value="' . $this->index . '">
                          <button id="' . $this->index . '" type="submit" class="btn btn-light">Отправить</button>

                    </div>
                </div>';
    }
}
