<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logout</title>
</head>
</html><?php
    unset($_SESSION['utente']);
    unset($_SESSION['password']);
    setcookie("utente", "", time() - 3600);
    header("location: index.php");
?>