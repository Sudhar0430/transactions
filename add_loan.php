<?php
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "transactions";  // replace with your DB name

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed."]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (
    isset($data['name'], $data['type'], $data['amount'], $data['interestRate'],
          $data['term'], $data['startDate'], $data['paymentFrequency'])
) {
    $stmt = $conn->prepare("
        INSERT INTO loans (name, type, amount, interest_rate, term, start_date, payment_frequency, remaining_balance)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "ssddiiss",
        $data['name'],
        $data['type'],
        $data['amount'],
        $data['interestRate'],
        $data['term'],
        $data['startDate'],
        $data['paymentFrequency'],
        $data['amount'] // initial remaining balance
    );

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "loanId" => $conn->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Database insert failed."]);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input data."]);
}

$conn->close();
?>
