<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root"; // Замените на ваше имя пользователя
$password = "a785410a"; // Замените на ваш пароль
$dbname = "events"; // Замените на имя вашей базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$location_name = $_POST['location_name'];
$address = $_POST['address'];

// SQL-запрос для добавления новой локации
$sql = "INSERT INTO location (address, name) VALUES ('$address', '$location_name')";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Новая локация успешно добавлена";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
