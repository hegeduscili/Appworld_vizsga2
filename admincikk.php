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
            // print "<a href='register.php'>Regisztráció</a>";
        }
        ?>

    </nav>

    <main>
        <div class="list">
            <h2>Cikkek szerkesztése</h2>
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
                            <td>Módosítás</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>";
                            print "<td>" . $row['cim'] . "</td>";
                            print "<td>" . $row['rovidismerteto'] . "</td>";
                            print "<td>" . $row['szerzo'] . "</td>";
                            print '<td><a href="editcikk.php?id=' . $row['id'] . '" class="edit">Szerkesztés</a>
                                    <a href="delete.php?id=' . $row['id'] . '" class="delete" data-id="' . $row['id'] . '">Törlés</a></td>';
                            print "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </form>
        </div>
    </main>
    <script>
        var deleteL = document.querySelectorAll(".delete");

        deleteL.forEach(function(link) {
            link.addEventListener("click", function(event) {
                event.preventDefault();

                var id = this.getAttribute("data-id");

                if (confirm("Biztos törölni akarja a cikket?")) {
                    window.location.href = "delete.php?id=" + id;
                }
            });
        });
    </script>
</body>

</html>