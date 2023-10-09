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


    
    <main class="admin_box">
        <div class="admin">
            <h2>Üdvözöljük <?php print $_SESSION["user"]["name"] ?>!</h2>
        </div>
    </main>
</body>

</html>
<?php
unset($_SESSION["post"])
?>