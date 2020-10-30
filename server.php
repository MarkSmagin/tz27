<?php
session_start();
class UserData {
    public function checkData()
    {
        if ($this->name != '' && $this->phone != '' && $this->email != '' && strlen($this->phone) >= 11 && ((stristr($this->email, '.') == '.com' || stristr($this->email, '.') == '.org')))
        {
            $this->returnSuccess();
            $this->saveData();
        }
        else
        {
            $this->returnError();
        }
    }

    public function saveData()
    {
        $this->checkSession();
        $this->checkCookie();
    }

    public function checkCookie()
    {
        if ($_COOKIE['user_id'] == $this->id)
        {
            if ($_COOKIE['user_name'] != $this->name)
            {
                setcookie('user_name', $this->name);
            }
            if ($_COOKIE['user_phone'] != $this->phone)
            {
                setcookie('user_phone', $this->phone);
            }
            if ($_COOKIE['user_email'] != $this->email)
            {
                setcookie('user_email', $this->email);
            } 
        }
        else
        {
            setcookie('user_name', $this->name);
            setcookie('user_phone', $this->phone);
            setcookie('user_email', $this->email);
        }
    }

    public function checkSession()
    {
        if (isset($_SESSION['user_id']))
        {
            if ($_SESSION['user_id'] == $this->id)
            {
                $_SESSION['user_name'] = $this->name;
                $_SESSION['user_phone'] = $this->phone;
                $_SESSION['user_email'] = $this->email;
            }
        }
        else
        {
            $_SESSION['user_id'] = $this->id;
            $_SESSION['user_name'] = $this->name;
            $_SESSION['user_phone'] = $this->phone;
            $_SESSION['user_email'] = $this->email;
        }
    }


    public function returnError()
    {
        if ($this->name == ''){
            setcookie('error_name', '<p style="color: red; font-size: 12px">Поле обязательно к заполнению</p>');
        }
        else
        {
            setcookie('error_name', '');
        }

        if ($this->phone == ''){
            setcookie('error_phone', '<p style="color: red; font-size: 12px">Поле обязательно к заполнению</p>');
        }
        else if (strlen($this->phone) < 11)
        {
            setcookie('error_phone', '<p style="color: red; font-size: 12px">Телефон слишком короткий</p>');
        }
        else
        {
            setcookie('error_phone', '');
        }

        if ($this->email == ''){
            setcookie('error_email', '<p style="color: red; font-size: 12px">Поле обязательно к заполнению</p>');
        }
        else if (stristr($this->email, '.') != '.com' && stristr($this->email, '.') != '.org')
        {
            setcookie('error_email', '<p style="color: red; font-size: 12px">Допускается указывать почту в доменах *.com и *.org</p>');
        }
        else
        {
            setcookie('error_email', '');
        }

        header('location: /index.php?user_name=' . $this->name . '&user_phone=' . $this->phone . '&user_email=' . $this->email);
    }

    public function returnSuccess()
    {
        header('location: /thanks.php?user_name=' . $this->name . '&user_phone=' . $this->phone . '&user_email=' . $this->email);
    }
}

$user = new UserData();
$user->name = $_POST['user_name'];
$user->phone = preg_replace('/[^0-9+]/', '', $_POST['user_phone']) ;
$user->email = $_POST['user_email'];
$user->id = $_COOKIE['user_id'];
$user->checkData();