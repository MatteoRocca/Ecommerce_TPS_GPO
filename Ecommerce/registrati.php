<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="darkmode.js"></script>
    <title>Register</title>
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
        if(!isset($_COOKIE["utente"])){
        echo '<button class="submitcheckbox">DarkMode';
        echo '<label class="switch">
                <input type="checkbox" id="checkbox" onclick="darkMode()">
                <span class="slider round"></span>
            </label></button>';
        ?>
            <script>
                if (getCookie('darkmode') == 1) document.getElementById("checkbox").checked = true;
            </script>
        <?php
    ?>
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <form action="registrati.php" method="post" class="login">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"><img class="img" src="png/utente.png"></i>
                            <input type="text" class="login__input" name="utente" placeholder="Utente">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"><img class="img" src="png/password.png"></i>
                            <input type="password" class="login__input" name="password" placeholder="Password">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"><img class="img" src="png/map_pin.png"></i>
                            <select name="provincia" class="login__input" placeholder="Provincia">
                                <option value="" style="color: #fff;" disabled selected>Provincia</option>
                                <?php
                                    exec("node api.js > /dev/null 2>&1 & echo $!", $output);
                                    $localitaJson = file_get_contents('http://localhost:3000/location');
                                    $localita = json_decode($localitaJson, true);
                                    
                                    foreach ($localita as $localitaItem) {
                                        $nomeProv = $localitaItem['Nome'];
                                        $siglaProv = $localitaItem['Provincia'];
                                        echo "<option value='" . $nomeProv . " " .  $siglaProv . "'>" . $nomeProv . " ". $siglaProv . "</option>";
                                    }
                                    $pid = (int)$output[0];
                                    exec("taskkill /pid $pid /f");                           
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="button login__submit" name="register">Registrati</button>
                        <a class="button login__submit" href="index.php">Indietro</a>
                    </form>
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>		
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>		
            </div>
        </div>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['register'])){
            $user = $_POST['utente'];
            $pwd = $_POST['password'];
            $provincia = $_POST['provincia'];

            $pezzo = explode(" ", $provincia);
            $nomeProv = $pezzo[0];
            $siglaProv = str_replace("", "", $pezzo[1]);

            if(strlen($user) > 3 AND strlen($pwd) >= 3){
                $conn = "mysql:host=localhost;dbname=archivio";

                try{
                    $pdo = new PDO($conn, 'root', '');

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                    if($pdo){
                        $sql = "SELECT * FROM account WHERE Email = :utente";

                        $statement = $pdo->prepare($sql);
                        $statement->bindParam('utente', $user);
                        $statement->execute();
                        $numRighe = $statement->rowCount();

                        if($numRighe > 0){
                            ?>
                            <script>
                                alert('Sei già registrato, vai alla pagina Accedi');
                                window.location = 'index.php';
                            </script>
                            <?php
                        }else{
                            $pwdcrypt = password_hash($pwd, PASSWORD_DEFAULT, ['cost' => 10]);
                            $sql = "INSERT INTO `account` (`Email`, `Password`, `Localita`, `Provincia`) VALUES (:utente, :pass, :loc, :prov)";

                            $statement = $pdo->prepare($sql);
                            $statement->bindParam('utente', $user);
                            $statement->bindParam('pass', $pwdcrypt);
                            $statement->bindparam('loc', $nomeProv);
                            $statement->bindparam('prov', $siglaProv);
                            $statement->execute();
                    
                            ?>
                            <script type='text/javascript'>
                                alert('Ti sei registrato correttamente');
                                window.location = 'index.php';
                            </script>
                            <?php
                        }
                    }
                }catch (PDOException $err) {
                    include 'errore404.php';
                    ?><h2><?php echo $err->getMessage(); ?></h2><?php
                }
            }else{
                ?>
                <script type='text/javascript'>
                    alert('Utente o Password troppo corta');
                </script>
                <?php
            }
        }else{ null; }
    }else{
        header("location: home.php");
    }
    ?>
</body>