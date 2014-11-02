<?php
// Connection à la BD
try {
    $bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch(PDOException $e) {
    die('Cannot connect to database: ' . $e->getMessage());
}
?>