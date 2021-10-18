<?php //conexxion à la base de données.
$login = 'root';
$password = 'root';
$pdo = new PDO('mysql:dbname=tchat;host=localhost', $login,$password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);