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
    <main>
        <div class="list">
            <h2>Cikkek szerkesztése</h2>
            <?php
            $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");
            if (!$connection_database) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $query = "SELECT cim, rovidismerteto, szerzo FROM cikkek";
            $result = mysqli_query($connection_database, $query);
            if (!$result) {
                die("Query failed: " . mysqli_error($connection_database));
            }
            ?>
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <td>Cím</td>
                            <td>Ismertető</td>
                            <td>Szerző</td>
                            <td>Módosítás</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>";
                            foreach ($row as $value) {
                                print "<td>" . $value . "</td>";
                            }
                            print '<td><button class="edit">Szerkesztés</button><button class="delete">Törlés</button></td>';
                            print "</tr>";
                        }
                        ?>
                        
                    </tbody>
                </table>
            </form>
        </div>
    </main>
    <script src="scripts.js"></script>
</body>

</html>