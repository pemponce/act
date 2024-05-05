<?php

$servername = "127.0.0.1";
$username = "root";
$password = "a785410a";
$dbname = "events";

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы
$event_name = $_POST['event_name'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$description = $_POST['description'];
$contact_info = $_POST['contact_info'];
$organizer_name = $_POST['organizer_name'];
$event_address = $_POST['event_address'];
$location_name = $_POST['location_name'];
$resource_description = $_POST['resource_description']; // Добавлено поле resource_description

// Подготовка и выполнение запроса для вставки данных о мероприятии
$sql_event = "INSERT INTO event (name, start_date, end_date, description) VALUES (?, ?, ?, ?)";
$stmt_event = $conn->prepare($sql_event);
$stmt_event->bind_param("ssss", $event_name, $start_date, $end_date, $description);

if ($stmt_event->execute()) {
    $last_event_id = $stmt_event->insert_id;

    // Подготовка и выполнение запроса для вставки данных о локации
    $sql_location = "INSERT INTO location (name, address, event_id) VALUES (?, ?, ?)";
    $stmt_location = $conn->prepare($sql_location);
    $stmt_location->bind_param("ssi", $location_name, $event_address, $last_event_id);

    if ($stmt_location->execute()) {
        // Подготовка и выполнение запроса для вставки данных об организаторе
        $sql_organizer = "INSERT INTO organizer (event_id, name, contact_info) VALUES (?, ?, ?)";
        $stmt_organizer = $conn->prepare($sql_organizer);
        $stmt_organizer->bind_param("iss", $last_event_id, $organizer_name, $contact_info);

        if ($stmt_organizer->execute()) {
            // Создание темы для мероприятия
            $sql_topic = "INSERT INTO topic (name, description, event_id) VALUES (?, ?, ?)";
            $stmt_topic = $conn->prepare($sql_topic);
            $stmt_topic->bind_param("ssi", $event_name, $description, $last_event_id);

            if ($stmt_topic->execute()) {
                // Вставка данных в таблицу session
                $sql_session = "INSERT INTO session (event_id, name, description) VALUES (?, ?, ?)";

                $stmt_session = $conn->prepare($sql_session);
                $stmt_session->bind_param("iss", $last_event_id, $event_name, $description);

                if ($stmt_session->execute()) {
                    // Вставка данных в таблицу resource
                    $sql_resource = "INSERT INTO resource (event_id, name, description) VALUES (?, ?, ?)";
                    $stmt_resource = $conn->prepare($sql_resource);
                    $stmt_resource->bind_param("iss", $last_event_id, $event_name, $resource_description);

                    if ($stmt_resource->execute()) {
                        header("Location: pages/home.php");
                    } else {
                        echo "Ошибка при добавлении ресурса: " . $stmt_resource->error;
                    }
                } else {
                    echo "Ошибка при создании сессии: " . $stmt_session->error;
                }
            } else {
                echo "Ошибка при создании темы: " . $stmt_topic->error;
            }
        } else {
            echo "Ошибка при добавлении организатора: " . $stmt_organizer->error;
        }
    } else {
        echo "Ошибка при добавлении локации: " . $stmt_location->error;
    }
} else {
    echo "Ошибка при добавлении мероприятия: " . $stmt_event->error;
}

// Закрытие подготовленных запросов и соединения с базой данных
$stmt_event->close();
$stmt_location->close();
$stmt_organizer->close();
$stmt_topic->close();
$stmt_resource->close(); // Закрываем подготовленный запрос для ресурса
$conn->close();
?>
