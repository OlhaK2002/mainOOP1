<?php

session_start();


//підключення до БД
/*include 'database.php';
$link = new PDO(PDO_DB, PDO_LOG, PDO_PAS);*/



//присвоєння даним нулю
/*$count_A=0;$count_a=0;$count_0=0;$error = 0;*/




//Сесіям помилок встановлюю пустий рядок
/*$_SESSION['error_email']="";
$_SESSION['error_login']="";
$_SESSION['error_passwords']="";
$_SESSION['error_password']="";
$_SESSION['error_password1']="";*/



//передача даних регістрації
/*$name = $_POST['Name'];
$surname = $_POST['Surname'];
$email = $_POST['Email'];
$login = $_POST['Login'];
$password1 = $_POST['Password1'];
$password2 = $_POST['Password2'];*/


//варифікація


        //перевірка email
        /*$sql1 = $link->prepare("SELECT * FROM `registor` WHERE `email`= :email");
        $sql1->bindParam(':email', $email, PDO::PARAM_STR);
        $sql1->execute();

        if($sql1->rowCount()>=1){
            $error++;
            $_SESSION['error_email'] = "Ваша почта уже используется другим пользователем";

        }*/




        //перевірка логіна
        /*$sql2 = $link->prepare("SELECT * FROM `registor` WHERE `login`= :login");
        $sql2->bindParam(':login', $login, PDO::PARAM_STR);
        $sql2->execute();

        if($sql2->rowCount()>=1){
            $error++;
            $_SESSION['error_login'] = "Ваш логин уже используется другим пользователем";
        }*/



        //перевірка пароля
        /*if($password1!=$password2){
            $error++;
            $_SESSION['error_passwords'] = "Пароли не совпадают";

        }

        if(strlen($password1)<6) {
            $error++;
            $_SESSION['error_password'] = "Пароль должен быть не меньше шести символов";

        }

        for($i=0;$i<strlen($password1);$i++)
        {
            if(($password1[$i]>='A'&& $password1[$i]<='Z')||($password1[$i]>='А'&& $password1[$i]<='Я'))$count_A++;
            if(($password1[$i]>='a'&& $password1[$i]<='z')||($password1[$i]>='а'&& $password1[$i]<='я'))$count_a++;
            if($password1[$i]>='0'&& $password1[$i]<='9')$count_0++;



            if(!($count_A>0 && $count_a>0 && $count_0 >0)) {
            $error++;
            $_SESSION['error_password1']="Пароль должен содержать цифры, а также символы верхнего и нижнего регистра";
            }
        }*/



        if($error>0){header("Location: registration.php");}
        else {

     //хешування
     /*$password = password_hash($password1, PASSWORD_DEFAULT);*/



    //внесення даних в базу даних
    /*$sql= $link->prepare("INSERT INTO `registor`(`name`,`surname`,`email`,`login`,`password1`) VALUES (:name, :surname, :email, :login, :password)");
    $sql->bindParam(':name', $name, PDO::PARAM_STR);
    $sql->bindParam(':surname', $surname, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':login', $login, PDO::PARAM_STR);
    $sql->bindParam(':password', $password, PDO::PARAM_STR);
    $sql->execute();*/


    //перевірка на внесені дані
    /*$sql1 = $link->prepare("SELECT * FROM `registor` WHERE `name`= :name and `surname`=:surname and `email`=:email and `login`=:login and `password1`=:password ");
    $sql1->bindParam(':name', $name, PDO::PARAM_STR );
    $sql1->bindParam(':surname', $surname, PDO::PARAM_STR);
    $sql1->bindParam(':email', $email, PDO::PARAM_STR);
    $sql1->bindParam(':login', $login, PDO::PARAM_STR);
    $sql1->bindParam(':password', $password, PDO::PARAM_STR);
    $sql1->execute();*/


    //результати регістрації
    /*if(!$sql1)
    {
        echo "Что-то пошло не так( Попробуйте зарегистрироваться заново!";
    }
    else {
        $arr = $sql1->FETCH(PDO::FETCH_ASSOC);
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;
        $_SESSION["user_id"] = $arr['user_id'];
        $_SESSION['error']="";
        $_SESSION['error_email']="";
        $_SESSION['error_login']="";
        $_SESSION['error_passwords']="";
        $_SESSION['error_password']="";
        $_SESSION['error_password1']="";
        header("Location: index.php");
    }*/


}
