<?php
$host = "localhost";
$db = "transactions";
$user = "root";
$pass = ""; // default password is empty in XAMPP

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$target = $_POST['target'];
$saved = $_POST['saved'];
$date = $_POST['date'];
$priority = $_POST['priority'];
$category = $_POST['category'];
$note = $_POST['note'];

$sql = "INSERT INTO goals (title, target_amount, saved_amount, target_date, priority, category, note)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sddssss", $title, $target, $saved, $date, $priority, $category, $note);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "error";
}

$stmt->close();
$conn->close();
?>
