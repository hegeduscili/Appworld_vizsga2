<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
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
            <h2>Regisztráció</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");

                $errors = [];

                $name_hossz = strlen($_POST["name"]);

                if ($name_hossz > 40 || $name_hossz < 3) {
                    $errors[] = 'A névnek, minimum 3, maximum 40 karakterből kell állnia.';
                }

                $isValidEmail = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

                if (!$isValidEmail) {
                    $errors[] = 'Az email invalid';
                } else {
                    $lekerdeze = mysqli_query($connection_database, "select id from admin where email = '{$_POST["email"]}'");

                    if (mysqli_num_rows($lekerdeze) > 0) {
                        $errors[] = 'Ez az email már használatban van!';
                    }
                }

                $password_hossz = strlen($_POST["password"]);

                if ($password_hossz < 4) {
                    $errors[] = 'A jelszónka, minimum 4 karakterből kell állnia!';
                } 
                if($_POST["password"] !== $_POST["password_confirmation"]) {
                    $errors[] = 'A két jelszó nem egyezik!';
                }


                if (count($errors) > 0) {
                    $_SESSION["errors"] = $errors;
                    $_SESSION["post"] = $_POST;
                } else {
                    $hashpass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    mysqli_query($connection_database, "INSERT INTO `admin` (`name`, `email`, `password`) VALUES ('{$_POST["name"]}', '{$_POST["email"]}', '$hashpass')");
                }
                $err = mysqli_error($connection_database);
                if ($err) {
                    die($err);
                }
                $_SESSION["success"] = 'Sikeres regisztráció!';


                header("location:" . $_SERVER["HTTP_REFERER"]);
                exit;
            }


            if (isset($_SESSION["errors"])) {
                print '<div class="error-messages">';
                foreach ($_SESSION["errors"] as $err) {
                    print '<div class="error">' . $err . '</div>';
                }
                print '</div>';
                unset($_SESSION["errors"]);
            } elseif (isset($_SESSION["success"])) {
                print '<div class="success-message">' . $_SESSION["success"] . '</div>';
                unset($_SESSION["success"]);
            }

            ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Adja meg a nevét!</label>
                    <input type="text" name="name" placeholder="Adja meg a nevét..." value="<?php print $_SESSION["post"]["name"] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="email">Adja meg az email címét!</label>
                    <input type="email" name="email" placeholder="Adja meg az emailt..." value="<?php print $_SESSION["post"]["email"] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="password">Adja meg a jelszavát!</label>
                    <input type="password" name="password" placeholder="Adja meg a jelszavát..." value="<?php print $_SESSION["post"]["password"] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Adja meg a jelszavát újra!</label>
        <input type="password" name="password_confirmation" placeholder="Adja meg a jelszavát ismét..." value="<?php print $_SESSION["post"]["password_confirmation"] ?? '' ?>">
                </div>
                <button type="submit">Regisztráció</button>
            </form>
        </div>

    </main>
</body>

</html>
<?php
unset($_SESSION["post"])
?>