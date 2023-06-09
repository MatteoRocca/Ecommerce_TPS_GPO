<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="darkmode.js"></script>
    <title>Home</title>
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
        echo '<button class="submitcheckbox">DarkMode';
        echo '<label class="switch">
                <input type="checkbox" id="checkbox" onclick="darkMode()">
                <span class="slider round"></span>
            </label></button>';

        echo '<a href="registrati.php"><button class="submit">Registrati</button></a>';
        echo '<a href="accedi.php"><button class="submit">Accedi</button></a><br><br>';
        ?>
            <script>
                if (getCookie('darkmode') == 1) document.getElementById("checkbox").checked = true;
            </script>
        <?php

        if(!isset($_COOKIE["utente"])){
        $connessione = "mysql:host=localhost;dbname=archivio";

            try {
                $pdo = new PDO($connessione, 'root', '');

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                if ($pdo) {
                    $sql = "SELECT prodotto.Id AS ProdId, prodotto.Nome, Prezzo, venditore.Id AS VendId, venditore.Nome AS NomeVenditore, venditore.Cognome AS CognomeVenditore FROM prodotto JOIN venditore ON IdVenditore = venditore.Id";
                    $statement = $pdo->prepare($sql);
                    $statement->execute();
                    $numRighe = $statement->rowCount();

                    if ($numRighe == 0) {
                        echo "Non ci sono articoli";
                    } else {
                        echo '<table class="table">
                                    <tr><th>Articoli</th></tr>

                                    <tr>
                                    <td>
                                        <table>
                                        <tr><th>Nome</th><th>Prezzo</th><th>Venditore</th></tr>';
                                            $ris = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($ris as $r) {
                                                echo '<tr class="row">';
                                                echo '<td>' . $r['Nome'] . '</td>
                                                                    <td>' . $r['Prezzo'] . ' €' . '</td>
                                                                    <td>' . $r['NomeVenditore'] ." ". $r['CognomeVenditore'] . '</td>';                                                         
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
            header("location: home.php");
        }
    ?>
</body>
</html>