<?php
// Получаем event_id из параметров URL
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, были ли заполнены обязательные поля
    if (empty($_POST['name']) || empty($_POST['contact_info'])) {
        $errorMessage = "Пожалуйста, заполните все обязательные поля.";
        echo "<script>showModal('$errorMessage');</script>";
        exit(); // Останавливаем выполнение скрипта
    }

    // Начало сессии
    session_start();

    // Проверка, вошел ли пользователь
    if (!isset($_SESSION['login_user'])) {
        header("location: logIn.php"); // Перенаправляем на страницу авторизации, если пользователь не вошел в систему
        exit();
    }

    // Подключение к базе данных
    $servername = "localhost";
    $username = "root"; // Замените на ваше имя пользователя
    $password = "a785410a"; // Замените на ваш пароль
    $dbname = "events"; // Замените на имя вашей базы данных

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $login_user = $_SESSION['login_user'];

    // Получение данных из формы регистрации
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM accounts WHERE username='$login_user'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
    }

    // Получение event_id из параметра URL
    if (!$event_id) {
        echo "Ошибка: Не указан ID мероприятия.";
        exit();
    }

    // Вставка данных о пользователе и аккаунте в таблицу participant
    $sql_insert_participant = "INSERT INTO participant (name, contact_info, account_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_participant);
    $stmt->bind_param("ssi", $name, $contact_info, $user_id);

    if ($stmt->execute()) {
        $participant_id = $conn->insert_id;

        // Вставка данных о регистрации в таблицу registration
        $registration_date = date('Y-m-d H:i:s');
        $status = 'pending'; // Начальный статус регистрации

        $sql_insert_registration = "INSERT INTO registration (event_id, participant_id, registration_date, status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert_registration);
        $stmt->bind_param("iiss", $event_id, $participant_id, $registration_date, $status);

        if ($stmt->execute()) {
            echo "Регистрация успешно добавлена!";
            header("Location: home.php");
            exit();
        } else {
            $errorMessage = "Ошибка при вставке данных в таблицу participant: " . $stmt->error;
            echo "<script>showModal('$errorMessage')</script>";
        }
    } else {
        $errorMessage = "Ошибка при вставке данных в таблицу participant: " . $stmt->error;
        echo "<script>showModal('$errorMessage')</script>";
    }

    // Закрытие соединения с базой данных
    $stmt->close();
    $conn->close();
}
?>
