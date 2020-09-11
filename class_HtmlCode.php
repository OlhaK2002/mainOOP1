<?php

class HtmlCode
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


