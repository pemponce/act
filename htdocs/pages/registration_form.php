<?php
// Получаем event_id из параметров URL
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация на мероприятие</title>
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
<div class="reg-container">
    <h2>Регистрация на мероприятие</h2>
    <form id="registrationForm" method="POST"> <!-- Добавлен event_id в параметры формы -->
        <?php include '../reg_form.php' ?>
        <div class="input-group">
            <label for="name">ФИО:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="contact_info">Контактная информация (телефон):</label>
            <input type="text" id="contact_info" name="contact_info" required>
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>

<!-- Модальное окно для отображения ошибки -->
<!-- Модальное окно -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-err"></p>
    </div>
</div>

<!-- Стили для модального окна -->
<style>
    .modal {
        display: none; /* Скрыто по умолчанию */
        position: fixed; /* Фиксированное положение */
        z-index: 1; /* Поверх всего остального */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Добавляет прокрутку, если контент слишком большой */
        background-color: rgba(0, 0, 0, 0.4); /* Черный цвет фона с прозрачностью */
    }

    /* Контент модального окна */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% от верхнего края экрана */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Ширина контента */
    }

    /* Закрыть кнопку */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    // Функция для отображения модального окна и заполнения информацией о мероприятии
    function showModal(err) {
        // Заполнение информации о мероприятии
        document.getElementById("modal-err").innerHTML = err;

        // Отображение модального окна
        document.getElementById("modal").style.display = "block";
    }

    // Закрытие модального окна при нажатии на крестик
    document.getElementsByClassName("close")[0].onclick = function () {
        document.getElementById("modal").style.display = "none";
    }

    // Закрытие модального окна при клике за его пределами
    window.onclick = function (event) {
        if (event.target == document.getElementById("modal")) {
            document.getElementById("modal").style.display = "none";
        }
    }
</script>
</body>
</html>
