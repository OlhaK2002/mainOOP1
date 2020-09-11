<?php
class VerificationR extends Registration
{
    protected $sql;
    protected $count_0=0;
    protected $count_A=0;
    protected $count_b=0;

    public function evidenceEmail()
    {

        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `email`= :email");
        $this->sql->bindParam(':email',$this->email,PDO::PARAM_STR);
        $this->sql->execute();

        if($this->sql->rowCount()>=1){$_SESSION['error_email'] = "Ваша почта уже используется другим пользователем";return false;}
        else {return true;}
    }

    public function evidenceLogin()
    {
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `login`= :login");
        $this->sql->bindParam(':login',$this->login,PDO::PARAM_STR);
        $this->sql->execute();

        if($this->sql->rowCount()>=1){$_SESSION['error_login'] = "Ваш логин уже используется другим пользователем";return false;}
        else {return true;}
    }

    public function evidencePasswords()
    {
        if($this->password1!=$this->password2){$_SESSION['error_passwords'] = "Пароли не совпадают";return false;}
        else {return true;}
    }

    public function evidencePassword()
    {
        if(strlen($this->password1)<6) {$_SESSION['error_password'] = "Пароль должен быть не меньше шести символов";return false;}
        else {return true;}
    }

    public function evidencePassword1()
    {

        for($i=0;$i<strlen($this->password1);$i++) {
            if ($this->password1[$i] >= 'A' && $this->password1[$i] <= 'Z') $this->count_A++;
            if ($this->password1[$i] >= 'a' && $this->password1[$i] <= 'z') $this->count_b++;
            if ($this->password1[$i] >= '0' && $this->password1[$i] <= '9') $this->count_0++;
        }
        if(!($this->count_A>0 && $this->count_b>0 && $this->count_0>0)) {
            $_SESSION['error_password1']="Пароль должен содержать цифры, а также символы верхнего и нижнего регистра";
            return false;
        }
        else return true;
    }

}
