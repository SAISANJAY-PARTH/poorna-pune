<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "service_learning");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$fullName = $data['fullName'];
$email = $data['email'];
$phone = $data['phone'];
$age = $data['age'];
$ticketQuantity = $data['ticketQuantity'];
$totalPrice = $data['totalPrice'];
$eventId = $data['eventId'];

$sql = "INSERT INTO registrations (fullName, email, phone, age, ticketQuantity, totalPrice, eventId)
        VALUES ('$fullName', '$email', '$phone', $age, $ticketQuantity, '$totalPrice', '$eventId')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Registration successful"]);
} else {
    echo json_encode(["error" => "Error: " . $conn->error]);
}

$conn->close();
?>
