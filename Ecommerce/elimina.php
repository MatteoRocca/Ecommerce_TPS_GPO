<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Elimina</title>
</head>
<body>
    <?php
    if(isset($_COOKIE["utente"])){
        $conn = "mysql:host=localhost;dbname=archivio";

        try{
            $pdo = new PDO($conn, 'root', '');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            if($pdo){
                $sql = "SELECT * FROM account WHERE Email = :utente";

                $statement = $pdo->prepare($sql);
                $statement->bindParam('utente', $_SESSION['utente']);
                $statement->execute();
                $numRighe = $statement->rowCount();

                if($numRighe != 1){
                    ?>
                    <script type='text/javascript'>
                        alert("Errore nel cancellare l'account");
                    </script>";
                    <?php
                }else{
                    $sql = "DELETE FROM account WHERE Email = :utente";

                    $statement = $pdo->prepare($sql);
                    $statement->bindParam('utente', $_SESSION['utente']);
                    $statement->execute();
                    
                    setcookie("utente", "", time() - 3600);
                    unset($_SESSION['utente']);
                    unset($_SESSION['password']);

                    ?>
                    <script type='text/javascript'>
                        alert("Utente cancellato correttamente");
                        window.location.href = "index.php";
                    </script>";                                  
                    <?php
                }
            }
        }catch (PDOException $err) {
            include 'errore404.php';
            if ($err->getCode() == 23000 && strpos($err->getMessage(), 'SQLSTATE[23000]') !== false) {
                $errore = "HTTP 500 (Internal Server Error) Non puoi cancellare l'account se hai ordini attivi";
                ?><h2><?php echo $errore ?></h2><?php
            }else
            {
                ?><h2><?php echo $err->getMessage(); ?></h2><?php
            }
        }
    }else{
        header("location: index.php");
    }
    ?>
</body>