<?php
  $connection_database = mysqli_connect("localhost", "root", "", "appworld_vizsga");
  if (!$connection_database) {
      die(mysqli_connect_error());
  }
  $query = "SELECT * FROM cikkek";
  $result = mysqli_query($connection_database, $query);

  $id = $_GET['id'];
echo "ID to delete: " . $id;
  $sql = "DELETE FROM cikkek WHERE id = '$id'";

if ($connection_database->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection_database->error;
}
header("location: admincikk.php");
exit;
$connection_database->close();
