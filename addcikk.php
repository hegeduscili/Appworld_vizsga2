<?php
session_start();

if (!isset($_SESSION["user"])) {
    $_SESSION["errors"] = ['Az oldal bejelentkezés után látogatható!'];
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cikk hozzáadása</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <h1>napihírek.hu</h1>
        <div class="altalanos">
            <a href="index.php">Kezdőlap</a>
            <a href="#">Mai hírek</a>
            <a href="#">Legtöbbször kattintott</a>
            <a href="editcikk.php">Hírek szerkesztése</a>
            <a href="addcikk.php">Új hír rögzítése</a>
        </div>

        <div class="felhasznalo">
            <a href="logout.php"></i>Kijelentkezés</a>
        </div>
    </nav>




    <main>
        <div class="register">
            <h2>Cikk hozzáadása</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");


                $errors = [];

                $szerzo_neve = strlen($_POST["szerzoneve"]);



                if ($szerzo_neve < 3) {
                    $errors[] = 'A szerző neve nem lehet rövidebb 3 karakternél!';
                }

                if ($_POST["cim"] === ''){
                    $errors[] = 'A cikknek kötelező címet adni!';
                }

                if ($_POST["rovidismerteto"] === ''){
                    $errors[] = 'A rövid ismertető nem lehet üres!';
                }

                if ($_POST["tartalom"] === ''){
                    $errors[] = 'A tartalom nem lehet üres!';
                }

                if (count($errors) > 0) {
                    $_SESSION["errors"] = $errors;
                    $_SESSION["post"] = $_POST;
                } else {
                    $hashpass = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    mysqli_query($connection_database, "INSERT INTO `cikkek` (`cim`,`rovidismerteto`, `szerzo`, `tartalom`) VALUES ('{$_POST["cim"]}','{$_POST["rovidismerteto"]}', '{$_POST["szerzoneve"]}', '{$_POST["tartalom"]}')",);
                }
                $err = mysqli_error($connection_database);
                if ($err) {
                    die($err);
                }
                $_SESSION["success"] = 'Sikeresen hozzáadta a cikket!';


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
                    <label for="szerzoneve">Adja meg a szerző nevét!</label><br>
                    <input type="text" name="szerzoneve" placeholder="Adja meg a szerző nevét..."><br><br>
                </div>

                <div class="form-group">
                    <label for="cim">Adja meg a cikk címét!</label><br>
                    <input type="text" name="cim" placeholder="Adja meg a cikk címét..."><br><br>
                </div>

                <div class="form-group">
                    <label for="cim">Adja meg a cikk ismertetőjét!</label><br>
                    <input type="text" name="rovidismerteto" placeholder="Adja meg a cikk ismertetőjét..."><br><br>
                </div>

                <div class="form-group">
                    <label for="tartalom">Adja meg a tartalmat!</label><br>
                    <textarea name="tartalom" id="tartalom"></textarea><br><br>
                </div>

                <button type="submit">Cikk Feltöltése</button>
            </form>
        </div>

    </main>
</body>

</html>


<?php
unset($_SESSION["post"])
?>