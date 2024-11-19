<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обратная связь</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Свяжитесь со мной</h1>
        <form action="" method="post">
            <label for="name">Ваше имя:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Ваш Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Ваш вопрос:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Отправить</button>
        </form>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);
            $timestamp = date("Y-m-d H:i:s");

            // Сохранение сообщения в файл
            $entry = "[$timestamp] Имя: $name, Email: $email, Сообщение: $message\n";
            if (file_put_contents('messages.txt', $entry, FILE_APPEND) === false) {
                echo "<p>Ошибка при сохранении сообщения.</p>";
            } else {
                echo "<p>Спасибо, $name! Ваш вопрос был отправлен.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
