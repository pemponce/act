<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <title>Регистрация и Авторизация</title>
</head>
<body>
<header>
    <h1>Расписание мероприятий</h1>
    <nav>
        <ul>
            <li><a href="home.php">Главная</a></li>
            <li><a href="events.php">Мероприятия</a></li>
            <li><a href="contact.php">Контакты</a></li>
            <li><a href="profile.php">Личный кабинет</a></li>
            <li><a href="logIn.php">Вход</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i><img style="width: 50px; height: 30px" src="../img/exit-svgrepo-com.svg"></a></li>

        </ul>
    </nav>
</header>
<div class="content" style="text-align: center">
    <div class="rounded-box">

        <h2>Авторизация</h2>
        <?php
        if (isset($_GET['registered'])) {
            echo "Регистрация прошла успешно, пожалуйста, войдите.";
        }
        ?>
        <form method="post" action="../log_in.php">
            <input type="text" name="username" placeholder="Имя пользователя" required><br>
            <input type="password" name="password" placeholder="Пароль" required><br>
            <input type="submit" name="login" value="Войти">
        </form>

        <p>Если у вас нет аккаунта, <a href="account_reg.php">зарегистрируйтесь</a>.</p>

    </div>
</div>


<footer>
    <p>&copy; <?php echo date("Y"); ?> Все права защищены.</p>
</footer>
</body>
</html>
