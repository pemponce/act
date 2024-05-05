<?php
// Регистрация нового пользователя


    $servername = "localhost";
    $username = "root";
    $password = "a785410a";
    $dbname = "events";

    $conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $contact_info = $_POST['contact_info'];

    // Хэширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Вставка нового пользователя в таблицу
    $sql_reg = "INSERT INTO accounts (username, password, full_name, gender, contact_info) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql_reg);
    $stmt->bind_param("sssss", $username, $hashed_password, $full_name, $gender, $contact_info);

    if ($stmt->execute()) {
        echo"<div>Круть</div>";
        exit();
    } else {
        $err = "Ошибка при регистрации: " . $stmt->error;
        echo"<div>$err</div>";
    }

    $stmt->close();
    $conn->close();


?>