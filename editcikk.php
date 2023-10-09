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
    <title>Cikk szerkesztése</title>
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
    <main></main>
</body>
</html>