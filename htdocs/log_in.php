<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "a785410a";
$dbname = "events";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Авторизация пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Получение пользователя из базы данных
    $sql = "SELECT * FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['login_user'] = $username;
            header("location: pages/home.php");
        } else {
            $error = "Неправильное имя пользователя или пароль";
            header("location: pages/logIn.php");
        }
    } else {
        header("location: pages/logIn.php");
        $error = "Неправильное имя пользователя или пароль";
    }
    $conn->close();
}
?>