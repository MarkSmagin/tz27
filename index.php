<?php
session_start();
if (!isset($_COOKIE['user_id']))
{
    setcookie('user_id', time());
    setcookie('user_visits', 1);
}
else
{
    setcookie('user_visits', $_COOKIE['user_visits'] + 1);
}
// if (isset($_SESSION))
// {
//     echo 'Пустой';
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/server.php" method="POST">
        <div>
            <h3>Введите имя:</h3>
            <input type="text" name="user_name" value="<?php echo $_SESSION['user_name'] ?? '' ?>">
            <?php echo $_COOKIE['error_name'] ?? '' ?>
        </div>
        <div>
            <h3>Введите телефон:</h3>
            <input type="tel" name="user_phone" value="<?php echo $_SESSION['user_phone'] ?? '' ?>">
            <?php echo $_COOKIE['error_phone'] ?? '' ?>
        </div>
        <div>
            <h3>Введите email:</h3>
            <input type="email" name="user_email" value="<?php echo $_SESSION['user_email'] ?? '' ?>">
            <?php echo $_COOKIE['error_email'] ?? '' ?>
        </div>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>