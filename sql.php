<?php
// Подключение к MySQL
$servername = "localhost"; // локалхост
$username = "root"; // имя пользователя
$password = ""; // пароль если существует
$dbname = "myDBPDO"; // база данных

// Создание соединения и исключения
try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

   // Установить режим ошибки PDO в исключение
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // Создание таблицы
   $sql = "CREATE TABLE MyGuests (
   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(50) NOT NULL,
   user_type INT(1)
   passwords VARCHAR(50) NOT NULL,
   register_date DATETIME NOT NULL
   )";

   // Используйте exec (), поскольку результат не возвращается
   $conn->exec($sql);
   echo "Таблица MyGuests создана успешно";
   }
catch(PDOException $e)
   {
   echo $sql . "<br>" . $e->getMessage();
   }

// Закрыть подключение
//$conn = null;
?>