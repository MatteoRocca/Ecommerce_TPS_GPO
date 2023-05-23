<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="darkmode.js"></script>
    <title>Login</title>
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
    <?php if(!isset($_COOKIE["utente"])){
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
                    <form action="accedi.php" method="post" class="login">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"><img class="img" src="png/utente.png"></i>
                            <input type="text" class="login__input" name="utente" placeholder="Utente" minlength="3">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"><img class="img" src="png/password.png"></i>
                            <input type="password" class="login__input" name="password" placeholder="Password" minlength="3">
                        </div>
                        <button type="submit" class="button login__submit" name="login">Accedi</button>
                        <a style="font-family: Raleway, sans-serif;" class="button login__submit" href="index.php">Indietro</a>
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
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['login'])){
            $user = $_POST['utente'];
            $pwd = $_POST['password'];
            
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

                    if($numRighe != 1){
                        ?>
                        <script type='text/javascript'>
                            alert('Non sei ancora registrato, vai alla pagina Registrati');
                        </script>
                        <?php
                    }else{
                        $sql = "SELECT `password` FROM `account` WHERE Email = :utente";

                        $statement = $pdo->prepare($sql);
                        $statement->bindParam('utente', $user);
                        $statement->execute();
                        $sqlpwd = $statement->fetch()['password'];
                        
                        if(password_verify($pwd, $sqlpwd)){
                            ?>
                            <script type='text/javascript'>alert('Ti sei loggato correttamente');</script>

                                <?php
                                    session_start();
                                    $_SESSION['utente'] = $user;
                                    header("location: home.php");

                                    setcookie('utente', $user, time()+3600); //Scade tra 1 ora
                        }else{
                            ?>
                            <script type='text/javascript'>
                                alert('Password errata, riprova');
                            </script>
                            <?php
                        }
                    }
                }
            }catch (PDOException $err) {
                include 'errore404.php';
                ?><h2><?php echo $err->getMessage(); ?></h2><?php
            }
        }
    }else{
        header("location: home.php");
    }
    ?>
</body>