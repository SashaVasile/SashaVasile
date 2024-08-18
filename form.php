<?php
// Получение данных из формы
$name = $_POST['fname'];
$phone = $_POST['lname'];
$email = $_POST['email'];
$message = $_POST['message'];
$services = implode(', ', $_POST); // Обработка чекбоксов

// Формирование письма
$to = 'sashavasilyev1996@yandex.ru'; // Замените на ваш email
$subject = 'Новая заявка с сайта';
$headers = "From: Your Name <your_email@example.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$body = "Имя: $name\n";
$body .= "Телефон: $phone\n";
$body .= "Email: $email\n";
$body .= "Сообщение: $message\n";
$body .= "Услуги: $services\n";

// Отправка письма
mail($to, $subject, $body, $headers);

// Обработка файла (опционально)
if ($_FILES['photo']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
}

echo 'Спасибо за отправку формы!';
?>
