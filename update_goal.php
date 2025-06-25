<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "transactions";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed");

$id = $_POST['id'];
$title = $_POST['title'];
$target = $_POST['target'];
$saved = $_POST['saved'];
$date = $_POST['date'];
$priority = $_POST['priority'];
$category = $_POST['category'];
$note = $_POST['note'];

$sql = "UPDATE goals SET 
        title='$title',
        target_amount=$target,
        saved_amount=$saved,
        target_date='$date',
        priority='$priority',
        category='$category',
        note='$note'
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
