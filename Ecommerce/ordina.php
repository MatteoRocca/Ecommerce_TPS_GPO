<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ordini</title>
</head>
<body>
    <?php
    if(isset($_COOKIE["utente"])){
        $prodotto = $_GET['IdProdotto'];
        $venditore = $_GET['IdVenditore'];
        $user = $_SESSION['utente'];

        if($prodotto != "" AND $venditore != ""){
            $connessione = "mysql:host=localhost;dbname=archivio";

            try {
                $pdo = new PDO($connessione, 'root', '');

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                if ($pdo) {
                    $sql = "SELECT Id FROM prodotto";
                    $statement = $pdo->prepare($sql);
                    $statement->execute();
                    $numRighe = $statement->rowCount();

                    if ($numRighe == 0) {
                        echo "Il prodotto non è disponibile";
                    } else {
                        $sql = "SELECT Id FROM account WHERE Email = :utente";

                        $statement = $pdo->prepare($sql);
                        $statement->bindParam('utente', $user);
                        $statement->execute();
                        $numRighe = $statement->rowCount();
                        $sqluser = $statement->fetch()['Id'];


                        $sql = "INSERT INTO ordine (IdVenditore, IdDestinatario, IdProdotto) VALUES (:venditore, :destinatario, :prodotto)";
                        $statement = $pdo->prepare($sql);
                        $statement->bindParam('venditore', $venditore);
                        $statement->bindParam('destinatario', $sqluser);
                        $statement->bindParam('prodotto', $prodotto);
                        $statement->execute();
                        $numRighe = $statement->rowCount();

                        header("location: home.php");
                    }
                }
            } catch (PDOException $err) {
                include 'errore404.php';
                ?><h2><?php echo $err->getMessage(); ?></h2><?php
            }
        }else header("location: home.php");
    }else header("location: index.php");
    ?>
</body>
</html>