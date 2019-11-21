
<?php

$dsn = "mysql:host=localhost;dbname=pos";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);


$stm = $pdo->query("SELECT VERSION()");

$version = $stm->fetch();
$errorCod = $stm->errorCode();
$execCod = $pdo->exec("set names utf8");

echo $version[0] . PHP_EOL;
echo $errorCod[0] . PHP_EOL;
echo $execCod[0] . PHP_EOL;