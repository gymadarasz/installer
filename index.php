<?php
include __DIR__ . '/config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$_code = mysqli_real_escape_string($conn, $_GET['code'] ?? null);
if (!$_code) throw new Exception('code parameter is missing');
$sql = sprintf("SELECT * FROM licence WHERE code = '%s' LIMIT 1", $_code);
$result = $conn->query($sql);
if (!$result) throw new Exception('database request error');
$row = $result->fetch_assoc();
echo json_encode($row);


$conn->close();