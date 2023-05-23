<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="darkmode.js"></script>
    <title>Carrello</title>
</head>
<body>
    <script>
        if (getCookie('darkmode') == 1) darkModeApplay();
        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }
    </script>
    <?php
    if(isset($_COOKIE["utente"])){
        echo '<button class="submitcheckbox">DarkMode';
        echo '<label class="switch">
                <input type="checkbox" id="checkbox" onclick="darkMode()">
                <span class="slider round"></span>
            </label></button>';
        echo '<a href="home.php"><button class="submit">Home</button></a><br><br>';
        ?>
            <script>
                if (getCookie('darkmode') == 1) document.getElementById("checkbox").checked = true;
            </script>
        <?php

        $user = $_SESSION['utente'];
        $connessione = "mysql:host=localhost;dbname=archivio";

        try {
            $pdo = new PDO($connessione, 'root', '');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            if ($pdo) {
                $sql = "SELECT * FROM ordine WHERE IdDestinatario = (SELECT Id FROM account WHERE Email = :utente)";
                $statement = $pdo->prepare($sql);
                $statement->bindParam('utente', $user);
                $statement->execute();
                $numRighe = $statement->rowCount();

                if ($numRighe == 0) {
                    echo "Non hai spedizioni attive";
                } else {
                    $sql = "SELECT Id FROM account WHERE Email = :utente";
                    $statement = $pdo->prepare($sql);
                    $statement->bindParam('utente', $user);
                    $statement->execute();
                    $sqlId = $statement->fetch()['Id'];

                    $sql = "SELECT ordine.Id AS OrdId, venditore.Id AS VendId, venditore.Nome AS NomeVenditore, venditore.Cognome AS CognomeVenditore, prodotto.Id AS ProdId, prodotto.Nome AS Prodotto, prodotto.Prezzo FROM ordine JOIN venditore ON ordine.IdVenditore = venditore.Id JOIN prodotto ON ordine.IdProdotto = prodotto.Id WHERE IdDestinatario = :utente";
                    $statement = $pdo->prepare($sql);
                    $statement->bindParam('utente', $sqlId);
                    $statement->execute();
                    $numRighe = $statement->rowCount();

                    echo '<table class="table">
                                    <tr><th>ORDINI</th></tr>

                                    <tr>
                                    <td>
                                        <table>
                                        <tr><th>Prodotto</th><th>Venditore</th><th>Prezzo</th><th>Azioni</th></tr>';
                                            $ris = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($ris as $r) {
                                                echo '<tr class="row">';
                                                echo '<td>' . $r['Prodotto'] . '</td>
                                                                    <td>' . $r['NomeVenditore'] ." ". $r['CognomeVenditore'] . '</td>
                                                                    <td>' . $r['Prezzo'] . ' €' . '</td>                                                                  
                                                                    <td>' . '<a href="traccia.php?IdOrdine=' . $r['OrdId'] . '"><button>Traccia</button></a><a href="annulla.php?IdOrdine=' . $r['OrdId'] . '"><button class="btncanc">Annulla</button></a>' . '</td>';
                                                echo '</tr>';
                                            }

                        echo            '</table>
                                    </td>
                                    </tr>
                                    
                            </table>';
                }
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