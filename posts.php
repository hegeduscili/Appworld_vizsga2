<?php
session_start();
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
            <a href="editcikk.php">Hírek szerkesztése</a>
            <a href="addcikk.php">Új hír rögzítése</a>
        </div>
        <div class="felhasznalo">
            <a href="login.php"></i>Bejelentkezés</a>
            <a href="#">Regisztráció</a>
        </div>
    </nav>
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



            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $id = mysqli_real_escape_string($connection_database, $id);

                $query = "SELECT * FROM cikkek WHERE id = $id";
                $result = mysqli_query($connection_database, $query);

                if (!$result) {
                    die(mysqli_error($connection_database));
                }
            
                // Fetch and store the data
                $data = mysqli_fetch_assoc($result);
            
                // Close the database connection
                mysqli_close($connection_database);
            }
            ?>


    <main>
    <div class="list" id="cikkek">
        <?php if (isset($data)): ?>
            <!-- Display the data here -->
            <h3><?php echo $data['cim']; ?></h3>
            <p><?php echo $data['tartalom']; ?></p>
            <h6>Szerző: <?php echo $data['szerzo']; ?></h6>
        <?php else: ?>
            <p>Data not found.</p>
        <?php endif; ?>
    </div>
    </main>
    <script src="scripts.js"></script>
</body>

</html>