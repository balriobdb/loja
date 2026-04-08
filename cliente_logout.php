<?php
include_once "objetos/ClienteController.php";
$controller = new ClienteController();
$controller->logout();
header("Location: index.php");
exit();
?>
