<?php
// Return JSON
header('Content-Type: application/json');

// Enable error reporting (for development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';
$dbname = 'transactions';      // ✅ Replace with your DB name
$username = 'root';                  // Default XAMPP username
$password = '';                      // Default XAMPP password is empty

// Connect to DB
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Read POST JSON input
$input = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!$input || !isset($input['type'], $input['category'], $input['amount'], $input['date'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

// Sanitize input
$type = $conn->real_escape_string($input['type']);
$category = $conn->real_escape_string($input['category']);
$amount = floatval($input['amount']);
$note = isset($input['note']) ? $conn->real_escape_string($input['note']) : '';
$date = $conn->real_escape_string($input['date']);

// Insert into DB
$sql = "INSERT INTO budget_entries (type, category, amount, note, date) VALUES ('$type', '$category', $amount, '$note', '$date')";

if ($conn->query($sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();
?>
