<?php
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Получение данных из формы
$name = sanitizeInput($_POST['fname']);
$phone = sanitizeInput($_POST['lname']);
$email = sanitizeInput($_POST['email']);
$message = sanitizeInput($_POST['message']);
$services = implode(', ', array_map('sanitizeInput', $_POST));

// Проверка на валидность email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Некорректный email";
    exit;
}

// Формирование письма
$to = 'sashavasilyev1996@yandex.ru';
$subject = 'Новая заявка с сайта';
$headers = "From: Your Name <your_email@example.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$body = "Имя: $name<br>";
$body .= "Телефон: $phone<br>";
$body .= "Email: $email<br>";
$body .= "Сообщение: $message<br>";
$body .= "Услуги: $services<br>";

// Отправка письма
if (mail($to, $subject, $body, $headers)) {
    echo "Спасибо за отправку формы! Мы свяжемся с вами в ближайшее время.";
} else {
    echo "Произошла ошибка при отправке сообщения.";
}

