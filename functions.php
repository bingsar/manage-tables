<?php

session_start();

$db = 'manager';
$user = 'root';
$pass = '';
$host = 'localhost';

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

function createTable($tableName) {

    global $pdo;
    $createTable = 'CREATE TABLE ' . $tableName . ' (id int NOT NULL AUTO_INCREMENT, name VARCHAR(50) NULL, PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET = utf8';
    $pdo->exec($createTable);

}

function showTables() {

    global $pdo;
    $showTables = 'SHOW TABLES';
    $stmt = $pdo->prepare($showTables);
    $stmt->execute();
    $tables = $stmt->fetchAll();
    $q = 1;
    foreach ($tables as $table) {
        echo $q++ . ') ' . '<a href="/tables.php?tableName=' . $table['Tables_in_manager'] . '">' . $table['Tables_in_manager'] . '</a>' . '<br>';
    }

}

function describeTable ($tableName)
{

    global $pdo;

    $stmt = $pdo->prepare("DESCRIBE $tableName");
    $stmt->execute();
    $tableFields = $stmt->fetchAll();

    echo '<table border="1" style="border: 1px"><tr>';
    foreach ($tableFields as $info) {
        echo '<td>' . $info['Field'] . ' <form method="POST">
<input type="hidden" name="tableName" value="' . $tableName . '">
<input type="hidden" name="existedName" value="' . $info['Field'] . '">
<input type="text" name="newName">
<input type="hidden" name="existedType" value="' . $info['Type'] . '">
<input type="submit" value="Изменить имя поля">
<input type="submit" name="delete" value="Удалить поле"></form></td>';
    }

    echo '</tr><tr>';

    foreach ($tableFields as $info) {
        echo '<td>' . $info['Type'] . '<form method="POST">
<input type="hidden" name="tableName" value="' . $tableName . '">
<input type="hidden" name="existedName" value="' . $info['Field'] . '">
<input type="text" name="newType" required>
<input type="submit" value="Изменить тип"></form></td> ';
    }

    echo '</tr></table>';

    echo '<br>';
    echo 'Добавить поле';
    echo '<br>'; echo '<br>';

    echo '<table border="1" style="border: 1px"><tr><td><form method="POST">
<input type="hidden" name="tableName" value="' . $tableName . '">
<input type="text" name="newField" value="Имя" required>
<input type="text" name="newType" value="Тип" required>
<input type="submit" value="Добавить поле"></form></td>';

    echo '</tr></table>';
}

function changeFieldName ($tableName, $existedName, $newName, $existedType) {

    global $pdo;
    $stmt = $pdo->prepare("ALTER TABLE $tableName CHANGE $existedName $newName $existedType");
    $stmt->execute();

}

function changeFieldType ($tableName, $existedName, $newType) {

    global $pdo;
    $stmt = $pdo->prepare("ALTER TABLE $tableName MODIFY $existedName $newType");
    $stmt->execute();

}

function addField ($tableName, $newField, $fieldType) {

    global $pdo;
    $stmt = $pdo->prepare("ALTER TABLE $tableName ADD $newField $fieldType");
    $stmt->execute();

}

function deleteField ($tableName, $existedName) {

    global $pdo;
    $stmt = $pdo->prepare("ALTER TABLE $tableName DROP COLUMN $existedName");
    $stmt->execute();

}