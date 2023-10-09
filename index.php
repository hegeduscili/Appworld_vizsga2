<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Napihírek.hu</title>
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
            <a href="login.php"></i>Bejelentkezés</a>
            <a href="#">Regisztráció</a>
        </div>
    </nav>
    <main>
    <div class="list">
            <h2>Cikkek</h2>
            <?php
            $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");
            if (!$connection_database) {
                die(mysqli_connect_error());
            }
            $query = "SELECT * FROM cikkek";
            $result = mysqli_query($connection_database, $query);
            if (!$result) {
                die(mysqli_error($connection_database));
            }
            ?>
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <td>Cím</td>
                            <td>Ismertető</td>
                            <td>Szerző</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><a href='posts.php?id=" . $row['id'] . "'>" . $row['cim'] . "</a></td>";

                        echo "<td>" . $row['rovidismerteto'] . "</td>";
                        echo "<td>" . $row['szerzo'] . "</td>";
                        echo "</tr>";
                    }
                        ?>
                        
                    </tbody>
                </table>
            </form>
        </div>
    </main>

    <footer></footer>
</body>

</html>