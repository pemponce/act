<?php
// Запуск или возобновление сессии
session_start();

// Уничтожение всех переменных сессии
$_SESSION = array();

// Удаление сессионной cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Уничтожение сессии
session_destroy();

// Перенаправление на страницу входа или на главную страницу
header("Location: pages/logIn.php"); // Измените на нужную страницу, если требуется
exit();
?>
