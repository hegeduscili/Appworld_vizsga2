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
    <title>Document</title>
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
        if (isset($_SESSION['user'])) {
            print " <a href='admincikk.php'>Hírek szerkesztése</a>";
            print "<a href='addcikk.php'>Új hír rögzítése</a>";
            print "<div class = 'felhasznalo'>";
            print "<a href='admin.php'>Profil</a>";
            print "<a href='logout.php'>Kijelentkezés</a>";
            print "</div>";
        } else {
            print "<a href='login.php'>Bejelentkezés</a>";
            //print "<a href='register.php'>Regisztráció</a>";
        }
        ?>

    </nav>

    <?php



if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");

    $errors = [];
    $szerzo_neve = strlen($_POST["szerzoneve"]);

    if ($szerzo_neve < 3) {
        $errors[] = 'A szerző neve nem lehet rövidebb 3 karakternél!';
    }

    if ($_POST["cim"] === '') {
        $errors[] = 'A cikknek kötelező címet adni!';
    }

    if ($_POST["rovidismerteto"] === '') {
        $errors[] = 'A rövid ismertető nem lehet üres!';
    }

    if ($_POST["tartalom"] === '') {
        $errors[] = 'A tartalom nem lehet üres!';
    }

    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        $_SESSION["post"] = $_POST;
    } else {

        if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
            mysqli_query($connection_database, "UPDATE `cikkek` SET
             `cim` = '{$_POST["cim"]}',
             `rovidismerteto` = '{$_POST["rovidismerteto"]}',
             `szerzo` = '{$_POST["szerzoneve"]}', 
             `tartalom` = '{$_POST["tartalom"]}'
             WHERE id = {$_GET['id']}");
        } else {
           $errors[] = ['Hibás vagy hiányzó cikk azonosító!'];
        }
    }
    $err = mysqli_error($connection_database);
    if ($err) {
        die($err);
    }
    $_SESSION["success"] = 'Sikeresen frissítette a cikket!';
    header("location:" . $_SERVER["HTTP_REFERER"]);
    exit;
} else {
    $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");
    if (!$connection_database) {
        die(mysqli_connect_error());
    }

    $data = [];
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $id = mysqli_real_escape_string($connection_database, $id);

        $query = "SELECT * FROM cikkek WHERE id = $id";
        $result = mysqli_query($connection_database, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
        } else {
            
            $_SESSION["errors"] = ['A cikk nem található!'];
        }
    }

    mysqli_close($connection_database);
}

?>

    <main>
      
        <div class="register">
            <h2>Cikk szerkesztése</h2>
            <?php
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
                    <label for="szerzoneve">Adja meg a szerző nevét!</label><br>
                    <input type="text" name="szerzoneve" placeholder="Adja meg a szerző nevét..." value="<?php print isset($data['szerzo']) ? $data['szerzo'] : ''; ?>"><br><br>
                </div>

                <div class="form-group">
                    <label for="cim">Adja meg a cikk címét!</label><br>
                    <input type="text" name="cim" placeholder="Adja meg a cikk címét..." value="<?php print $data['cim'] ?>"><br><br>
                </div>

                <div class="form-group">
                    <label for="rovidismerteto">Adja meg a cikk ismertetőjét!</label><br>
                    <input type="text" name="rovidismerteto" placeholder="Adja meg a cikk ismertetőjét..." value="<?php print $data['rovidismerteto'] ?>"><br><br>
                </div>

                <div class="form-group">
                    <label for="tartalom">Adja meg a tartalmat!</label><br>
                    <textarea name="tartalom" id="tartalom"><?php if (isset($data)) print $data['tartalom']; ?></textarea><br><br>
                </div>

                <button type="submit">Cikk Feltöltése</button>
            </form>
        </div>
    </main>
    <script src="scripts.js"></script>

</body>

</html>

<?php
unset($_SESSION["post"])
?>