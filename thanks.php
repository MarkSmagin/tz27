<?php
if(!isset($_GET['user_name']))
{
    header('location: /index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/thanks.php">
    <p>Спасибо, <?php echo $_GET['user_name'] ?>, мы свяжемся с вами в ближайшее время!</p>
    <button type="submit">Вернуться на главную страницу</button>
    </form>
</body>
</html>