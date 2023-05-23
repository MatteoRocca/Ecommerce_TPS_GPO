<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="darkmode.js"></script>
    <title>Traccia</title>
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

        echo '<a href="carrello.php"><button class="submit">Indietro</button></a>';
        echo '<a href="home.php"><button class="submit">Home</button></a><br><br>';
        ?>
            <script>
                if (getCookie('darkmode') == 1) document.getElementById("checkbox").checked = true;
            </script>
        <?php

        $ordine = $_GET['IdOrdine'];
        $connessione = "mysql:host=localhost;dbname=archivio";

        try {
            $pdo = new PDO($connessione, 'root', '');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            if ($pdo) {

                $sql = "SELECT magazzino.Localita AS Loc, magazzino.Provincia AS Prov FROM prodotto JOIN magazzino ON IdMagazzino = magazzino.Id JOIN ordine ON prodotto.id = IdProdotto WHERE ordine.Id = :ordine";
                $statement = $pdo->prepare($sql);
                $statement->bindParam('ordine', $ordine);
                $statement->execute();

                $ris = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($ris as $r) {
                        $sqlLocVend = $r['Loc'];
                        $sqlProvVend = $r['Prov'];
                    }
                
                $sql = "SELECT Localita AS Loc, Provincia AS Prov FROM account JOIN ordine ON account.Id = IdDestinatario WHERE ordine.Id = :ordine";
                $statement = $pdo->prepare($sql);
                $statement->bindParam('ordine', $ordine);
                $statement->execute();

                $ris = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($ris as $r) {
                        $sqlLocAcq = $r['Loc'];
                        $sqlProvAcq = $r['Prov'];
                    }
                if(isset($sqlProvAcq))
                    $url = "https://www.google.com/maps/embed/v1/directions?origin=+" . $sqlLocVend . ",+" . $sqlProvVend . ",+Italia&destination=" . $sqlLocAcq . ",+" . $sqlProvAcq . ",+Italia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8";    
                else
                header("location: home.php");
                }
        } catch (PDOException $err) {
            include 'errore404.php';
            ?><h2><?php echo $err->getMessage(); ?></h2><?php
        }
    }else{
        header("location: index.php");
    }
    ?>

    <!-- https://www.embed-map.com/ -->
    <div class="mappa">
        <div id="google-maps-display">
            <iframe class="iframe" frameborder="0" src="<?php echo $url; ?>"></iframe>
            <!-- <iframe class="iframe" frameborder="0" src="https://www.google.com/maps/embed/v1/directions?origin=Bergamo,+BG,+Italia&destination=Milano,+MI,+Italia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe> -->
        </div>
    </div>
</body>
</html>