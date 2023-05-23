<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Annulla</title>
</head>
<body>
    <?php
    if(isset($_COOKIE["utente"])){
        $ordine = $_GET['IdOrdine'];

        $connessione = "mysql:host=localhost;dbname=archivio";

        try {
            $pdo = new PDO($connessione, 'root', '');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            if ($pdo) {

                $sql = "DELETE FROM ordine WHERE Id = :ordine";
                $statement = $pdo->prepare($sql);
                $statement->bindParam('ordine', $ordine);
                $statement->execute();

                header("location: carrello.php");
            }
        } catch (PDOException $err) {
            include 'errore404.php';
            ?><h2><?php echo $err->getMessage(); ?></h2><?php
        }
    }else{
        header("location: index.php");
    }
    ?>
</body>
</html>