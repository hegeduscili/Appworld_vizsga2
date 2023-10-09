<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<nav>
    <h1>napihírek.hu</h1>
    <div class="altalanos">
            <a href="index.php">Kezdőlap</a>
            <a href="#">Mai hírek</a>
            <a href="#">Legtöbbször kattintott</a>
        </div>
       
            <?php
              if(isset($_SESSION['user'])) {
                echo " <a href='editcikk.php'>Hírek szerkesztése</a>";
                echo "<a href='addcikk.php'>Új hír rögzítése</a>";
                echo "<div class = 'felhasznalo'>";
                echo "<a href='admin.php'>Profil</a>";
                echo "<a href='logout.php'>Kijelentkezés</a>";
                echo "</div>";
            } else {
                echo "<a href='login.php'>Bejelentkezés</a>";
                echo "<a href='register.php'>Regisztráció</a>";
            }
            ?>
    
    </nav>


    <main>
        <div class="register">
            <h2>Bejelentkezés</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");

                $errors = [];

                $isValidEmail = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

                if (!$isValidEmail) {
                    $errors[] = 'Az email invalid';
                } else {
                    $lekerdeze = mysqli_query($connection_database, "select * from admin where email = '{$_POST["email"]}'");

                    if (mysqli_num_rows($lekerdeze) === 0) {
                        $errors[] = 'A felhasználó nem található!';
                    }else{
                        $user = mysqli_fetch_array($lekerdeze);
                    }
                }

                $password_hossz = strlen($_POST["password"]);

                if ($password_hossz < 4) {
                    $errors[] = 'A jelszónka, minimum 4 karakterből kell állnia!';
                } 


                if (count($errors) > 0) {
                    $_SESSION["errors"] = $errors;
                    $_SESSION["post"] = $_POST;
                } else {
                   $loginressult = password_verify($_POST["password"],$user["password"]);


                    if(!$loginressult){
                        $errors[] = 'Sikertelen bejelentkezés!';
                        $_SESSION["errors"] = $errors;
                        $_SESSION["post"] = $_POSt;
                    }else{
                        $_SESSION["user"] = $user;
                        $_SESSION["success"] = 'Sikeres bejelentkezés!';
                        header("location: admin.php");
                        exit;
                    }

                }
               
                header("location:" . $_SERVER["HTTP_REFERER"]);
                exit;
            }


            if (isset($_SESSION["errors"])) {
                print '<div class="error-messages">';
                foreach ($_SESSION["errors"] as $err) {
                    print '<div class="error">' . $err . '</div>';
                    unset($_SESSION["errors"]);
                }
                print '</div>';
            } elseif (isset($_SESSION["success"])) {
                print '<div class="success-message">' . $_SESSION["success"] . '</div>';
                unset($_SESSION["success"]);
            }

            ?>

            <form action="" method="POST">
               
                <div class="form-group">
                    <label for="email">Adja meg az email címét!</label>
                    <input type="email" name="email" placeholder="Adja meg az emailt..." value="<?php print $_SESSION["post"]["email"] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="password">Adja meg a jelszavát!</label>
                    <input type="password" name="password" placeholder="Adja meg a jelszavát..." value="<?php print $_SESSION["post"]["password"] ?? '' ?>">
                </div>
                
                <button type="submit">Bejelentkezés</button>
            </form>
        </div>

    </main>
</body>

</html>
<?php
unset($_SESSION["post"])
?>