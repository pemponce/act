<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание мероприятия и организатора</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<header>
    <h1>Создание мероприятия и организатора</h1>
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
        <section>
            <h2>Заполните данные мероприятия и организатора</h2>
            <form action="../process_event.php" method="post">
                <label for="event_name">Название мероприятия:</label><br>
                <input type="text" id="event_name" name="event_name"><br>


                <label for="event_address">адресс мероприятия:</label><br>
                <input type="text" id="event_address" name="event_address"><br>
                <label for="location_name">Название локации:</label><br>
                <input type="text" id="location_name" name="location_name"><br>


                <label for="start_date">Дата начала:</label><br>
                <input type="date" id="start_date" name="start_date"><br>
                <label for="end_date">Дата окончания:</label><br>
                <input type="date" id="end_date" name="end_date"><br>
                <label for="description">Описание:</label><br>
                <textarea id="description" name="description"></textarea><br>
                <label for="contact_info">Контактная информация:</label><br>
                <input type="text" id="contact_info" name="contact_info"><br>
                <label for="organizer_name">Имя организатора:</label><br>
                <input type="text" id="organizer_name" name="organizer_name"><br>
                <br/>
                <label for="resource_description">Рекомендации для участников:</label><br>
                <textarea id="resource_description" name="resource_description"></textarea><br>
                <button type="submit">Создать мероприятие и организатора</button>
            </form>
        </section>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Все права защищены.</p>
</footer>
</body>
</html>
