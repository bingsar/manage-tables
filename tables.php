<?php
require_once 'functions.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

showTables();

echo '<br>';

if (isset($_GET['tableName'])) {
    echo 'Название таблицы - ' . $_GET['tableName'] . '<br>' . '<br>';
    describeTable($_GET['tableName']);
}

if (isset($_POST['newName'])) {
    changeFieldName($_POST['tableName'], $_POST['existedName'], $_POST['newName'], $_POST['existedType']);
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['newType'])) {
    changeFieldType($_POST['tableName'], $_POST['existedName'], $_POST['newType']);
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['delete'])) {
    deleteField($_POST['tableName'], $_POST['existedName']);
}

if (isset($_POST['newField'])) {
    addField($_POST['tableName'], $_POST['newField'], $_POST['newType']);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<br>
<a href="index.php">Перейти к добавлению таблицы</a>
</body>
</html>