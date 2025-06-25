<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "fintrack";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed");

$id = $_POST['id'];

$sql = "DELETE FROM goals WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
