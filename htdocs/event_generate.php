<?php
$servername = "127.0.0.1";
$username = "root";
$password = "a785410a";
$dbname = "events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;
$offset = ($page - 1) * $limit;

$sql = "SELECT e.id, e.name AS event_name, e.start_date, e.end_date, e.description AS event_description, 
               l.address, l.name AS location_name, 
               o.name AS organizer_name, o.contact_info AS contact_info, t.name AS topic_name, t.description AS topic_description,
               calculate_duration(e.start_date, e.end_date) AS event_duration
        FROM event e
        INNER JOIN location l ON e.id = l.event_id 
        INNER JOIN organizer o ON e.id = o.event_id
        INNER JOIN topic t ON e.id = t.event_id
        ORDER BY e.id DESC
        LIMIT $limit OFFSET $offset";


$result = $conn->query($sql);

if (!$result) {
    die("Ошибка запроса: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<div class='event-container'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event'>";
        echo "<h3>" . $row["topic_name"] . "</h3>";
        echo "<p>Дата: " . date("d.m", strtotime($row["start_date"])) . " - " . date("d.m", strtotime($row["end_date"])) . "</p>";
        echo "<p>Место: " . $row["address"] . "</p>";
        echo "<p>Организатор: " . $row["organizer_name"] . "</p>";

        // Преобразование event_duration из часов в дни
        $event_duration_days = intval($row["event_duration"]) / 24;

        // Обновленный SQL-запрос для выборки данных из таблицы resources
        $sql_resources = "SELECT description FROM resource WHERE event_id = " . $row['id'];
        $result_resources = $conn->query($sql_resources);

        if (!$result_resources) {
            die("Ошибка запроса: " . $conn->error);
        }

        $resource_description = ""; // Инициализация переменной для описания ресурса

        if ($result_resources->num_rows > 0) {
            // Обработка результатов запроса
            while ($resource_row = $result_resources->fetch_assoc()) {
                // Собираем описание ресурса
                $resource_description .= $resource_row["description"] . ", ";
            }
            // Удаляем последнюю запятую и пробел
            $resource_description = rtrim($resource_description, ", ");
        }

        // Добавляем кнопку "Подробнее" с вызовом JavaScript функции для отображения дополнительной информации
        echo "<div class='button-container'>";

        echo "<button class='register-button' style='margin: auto 10px;' onclick=\"showModal('" . $row["event_name"] . "',
     '" . date("d.m", strtotime($row["start_date"])) . "', '" . date("d.m", strtotime($row["end_date"])) . "', '" . $event_duration_days . "', '" . $row["address"] . "', '" . $row["location_name"] . "' ,
      '" . $row["topic_description"] . "', '" . $resource_description . "', '" . $row["organizer_name"] . "', '" . $row["contact_info"] . "')\">Подробнее</button>";

        // Добавляем кнопку "Зарегистрироваться" с ссылкой на форму регистрации события
        echo "<a href='registration_form.php?event_id=" . $row["id"] . " ' class='register-button' style='margin: auto 10px;'>Зарегистрироваться</a>";

        echo "</div>"; // Закрываем div.button-container
        echo "</div>"; // Закрываем div.event
    }
    echo "</div>"; // Закрываем div.event-container
} else {
    echo "0 результатов";
}

// Выводим кнопки перелистывания
$sql_count = "SELECT COUNT(*) AS total FROM event";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_pages = ceil($row_count['total'] / $limit);

if ($total_pages > 1) {
    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='events.php?page=" . ($page - 1) . "' class='button_left'>Назад</a>";
    }
    if ($page < $total_pages) {
        echo "<a href='events.php?page=" . ($page + 1) . "' class='button_right'>Вперёд</a>";
    }
    echo "</div>";
}

$conn->close();
?>
