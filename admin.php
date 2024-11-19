<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка - Сообщения</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Вход в админку</h1>

        <?php
        session_start();

        // Установите ваш пароль
        $admin_password = '@@Mam1@@'; // Замените 'yourpassword' на ваш пароль

        // Проверка, если пользователь уже вошел
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            echo "<h2>Сообщения от пользователей</h2>";

            if (file_exists('messages.txt')) {
                $messages = file_get_contents('messages.txt');
                if (!empty($messages)) {
                    echo "<pre>$messages</pre>";
                } else {
                    echo "<p>Нет сообщений.</p>";
                }
            } else {
                echo "<p>Файл сообщений не найден.</p>";
            }

            echo '<a href="index.php">Вернуться на главную</a>';
        } else {
            // Если пользователь не вошел, показываем форму для ввода пароля
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $password = htmlspecialchars($_POST['password']);
                
                if ($password === $admin_password) {
                    $_SESSION['logged_in'] = true;
                    echo "<h2>Вы успешно вошли!</h2>";
                    echo "<h2>Сообщения от пользователей</h2>";

                    if (file_exists('messages.txt')) {
                        $messages = file_get_contents('messages.txt');
                        if (!empty($messages)) {
                            echo "<pre>$messages</pre>";
                        } else {
                            echo "<p>Нет сообщений.</p>";
                        }
                    } else {
                        echo "<p>Файл сообщений не найден.</p>";
                    }

                    echo '<a href="index.php">Вернуться на главную</a>';
                } else {
                    echo "<p style='color:red;'>Неверный пароль. Попробуйте еще раз.</p>";
                }
            }
            ?>

            <form action="" method="post">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Войти</button>
            </form>

            <?php
        }
        ?>
    </div>
</body>
</html>
