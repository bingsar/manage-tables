<?php

require_once 'functions.php';

if (isset($_POST['tableName'])) {
    createTable($_POST['tableName']);
    header('Location: tables.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Manager</title>
</head>
<body>

<form method="POST">
    <input type="text" name="tableName" required>
    <input type="submit" value="Создать таблицу">
</form>
<br>
<a href="tables.php">Перейти к списку таблиц</a>

</body>
</html>
