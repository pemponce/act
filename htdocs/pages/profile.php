<?php
session_start();

// Проверка, вошел ли пользователь
if (!isset($_SESSION['login_user'])) {
    header("location: logIn.php"); // Перенаправляем на страницу авторизации, если пользователь не вошел в систему
    exit();
}

// Подключение к базе данных (замените данными вашей базы)
$servername = "localhost";
$username = "root";
$password = "a785410a";
$dbname = "events";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение информации о текущем пользователе из базы данных
$login_user = $_SESSION['login_user'];
$sql = "SELECT * FROM accounts WHERE username='$login_user'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $gender = $row['gender'];
    $contact_info = $row['contact_info'];
} else {
    echo "Ошибка: Пользователь не найден в базе данных.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Личный кабинет</title>
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

        <h1>Добро пожаловать в ваш личный кабинет, <?php echo $full_name; ?>!</h1>
        <p><strong>Имя пользователя:</strong> <?php echo $login_user; ?></p>
        <p><strong>Пол:</strong> <?php echo $gender; ?></p>
        <p><strong>Контактная информация:</strong> <?php echo $contact_info; ?></p>
        <a class="button_left" href="../logout.php">Выйти</a>
    </div>
</div>


<footer>
    <p>&copy; <?php echo date("Y"); ?> Все права защищены.</p>
</footer>
</body>

</html>
