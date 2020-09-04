<?php

    session_start();

    $error = 0;

    $link = mysqli_connect("127.0.0.1", "root", "root", "guest_book");

    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $email = $_POST['Email'];
    $login = $_POST['Login'];
    $password1 = $_POST['Password1'];
    $password2 = $_POST['Password2'];

    if($password1!=$password2){
        echo 'Пароли не совпадают';
        die;
    }
    $sql1 = mysqli_query($link,"SELECT * FROM `registor` WHERE `email`= '$email'");

    if(mysqli_num_rows($sql1)>=1){
        //$error = "Ваша почта уже используется другим пользователем";
        $error++;
       echo '<span style="color: red">Ваша почта уже используется другим пользователем </span>'.'<br/>'.'<br/>';

    }

    $sql2= mysqli_query($link,"SELECT * FROM `registor` WHERE `login`= '$login'");

    if(mysqli_num_rows($sql2)>=1){
        $error++;
        echo '<span style="color: red">Ваш логин уже используется другим пользователем</span>'.'<br/>'.'<br/>';
    }

    if(strlen($password1)<6) {
        $error++;
        echo '<span style="color: red">Пароль должен быть не меньше шести символов</span>'.'<br/>'.'<br/>';

    }
    // $k=0;$l=0;$m=0;
     // for($i=0;$i<strlen($password1);$i++)
     // {
     //   if($password1[$i]>='A'&&$password1[$i]<='Z')$k++;
    //    if($password1[$i]>='a'&&$password1[$i]<='z')$l++;
   //   if($password1[$i]>='0'&&$password1[$i]<='9')$m++;
   // }
    //     if($k=0||$l=0||$m=0){
     //    echo 'Пароль должен содержать цифры, а также символы верхнего и нижнего регистра';
     //   die;
    // }

    if($error>0){ echo '<a href="registration.html">Вернуться на страницу регистрации</a>';}
    else {

        $password = password_hash($password1, PASSWORD_DEFAULT);
        //echo $password;

        $sql = "INSERT INTO `registor`(`name`,`surname`,`email`,`login`,`password1`) VALUES ('$name', '$surname', '$email', '$login', '$password')";

        if (!mysqli_query($link, $sql)) {
            echo "Что-то пошло не так( Попробуйте зарегистрироваться заново!";
        } else {
            //echo "Регистрация успешно выполнена!";
            $_SESSION["login"] = $login;
            $_SESSION["password1"] = $password;
            header("Location: index.php");
        }

        mysqli_close($link);
    }
