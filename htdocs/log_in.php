<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "events";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Регистрация нового пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['reg_username'];
    $password = $_POST['reg_password'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $contact_info = $_POST['contact_info'];

    // Защита от SQL инъекций
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $gender = mysqli_real_escape_string($conn, $gender);
    $contact_info = mysqli_real_escape_string($conn, $contact_info);

    // Хэширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Вставка нового пользователя в таблицу
    $sql = "INSERT INTO accounts (username, password, full_name, gender, contact_info) VALUES ('$username', '$hashed_password', '$full_name', '$gender', '$contact_info')";
    if ($conn->query($sql) === TRUE) {
        echo "Регистрация прошла успешно";
        header("Location: pages/logIn.php");
        exit();
    } else {
        echo "Ошибка при регистрации: " . $conn->error;
    }

}

// Авторизация пользователя
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Защита от SQL инъекций
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

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
        }
    } else {
        $error = "Неправильное имя пользователя или пароль";
    }
}
?>