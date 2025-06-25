<?php
// Database connection details
$host = "localhost";      // Change if needed
$user = "root";           // Default for XAMPP/WAMP
$password = "";           // Default for XAMPP/WAMP
$database = "transactions"; // Database name (from your screenshot)

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (
    isset($data['type']) &&
    isset($data['description']) &&
    isset($data['amount']) &&
    isset($data['category']) &&
    isset($data['date'])
) {
    // Sanitize inputs
    $type = $conn->real_escape_string($data['type']);
    $description = $conn->real_escape_string($data['description']);
    $amount = floatval($data['amount']);
    $category = $conn->real_escape_string($data['category']);
    $date = $conn->real_escape_string($data['date']);

    // Insert into DB
    $sql = "INSERT INTO transactions (type, description, amount, category, transaction_date)
            VALUES ('$type', '$description', $amount, '$category', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Transaction added successfully!";
    } else {
        echo "❌ Error: " . $conn->error;
    }
} else {
    echo "❌ Missing required data!";
}

// Close connection
$conn->close();
?>
