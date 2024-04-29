<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="../style/style.css"> <!-- Подключите ваш файл стилей -->
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
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i><img style="width: 50px; height: 30px" src="../img/exit-svgrepo-com.svg"></a></li>

        </ul>
    </nav>
</header>

<div class="content">
    <div class="rounded-box">
        <h2>Добро пожаловать на сайт по просмотру мероприятий!</h2>
        <div class="button-container">
            <button class="button_left" onclick="location.href='events.php'">Просмотреть мероприятия</button>
            <button class="button_right" onclick="location.href='event_creator.php'">Создать мероприятие</button>
        </div>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Все права защищены.</p>
</footer>
</body>
</html>
