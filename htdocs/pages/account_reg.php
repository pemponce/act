<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Регистрация</title>
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
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i><img style="width: 50px; height: 30px"
                                                                                src="../img/exit-svgrepo-com.svg"></a>
            </li>
        </ul>
    </nav>
</header>
<div class="content" style="text-align: center">
    <div class="rounded-box">
        <h2>Регистрация</h2>

        <form id="acc_round" method="POST" onsubmit="submitForm(event)">
            <input type="text" id="username" name="username" placeholder="ваш_никнейм" required><br>
            <input type="password" id="password" name="password" placeholder="пароль" required><br>
            <input type="text" id="full_name" name="full_name" placeholder="ФИО" required><br>
            <input type="text" id="gender" name="gender" placeholder="пол" required><br>
            <input type="text" id="contact_info" name="contact_info" placeholder="ваш_номер_телефона" required><br>
            <input type="submit" id="register" name="register" value="Зарегистрироваться">
        </form>
    </div>
</div>

<!-- Модальное окно для отображения ошибки -->
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

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% от верхнего края экрана */
        padding: 20px;
        border: 1px solid #888;
        width: 40%; /* Ширина контента */
    }

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

<!-- JavaScript для модального окна -->
<script>
    function showModal(err) {
        document.getElementById("modal-err").innerHTML = err;
        document.getElementById("modal").style.display = "block";
    }

    document.getElementsByClassName("close")[0].onclick = function () {
        document.getElementById("modal").style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target === document.getElementById("modal")) {
            document.getElementById("modal").style.display = "none";
        }
    }

    function submitForm(event) {
        event.preventDefault();

        let form = document.getElementById('acc_round');
        let formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../sign_in.php', true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                let response = xhr.responseText;
                if (response.includes('Ошибка')) {
                    showModal(response);
                } else {
                    window.location.href = 'logIn.php';
                }
            }
        }

        xhr.send(formData);
    }

</script>
</body>
</html>