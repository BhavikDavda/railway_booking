<?php
include 'config.php';

// Create User
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
    echo $conn->query($query) ? "User Added" : "Error: " . $conn->error;
}

// Read Users
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM users");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
}

// Update User
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['user_id'];
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];

    $query = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE user_id=$id";
    echo $conn->query($query) ? "User Updated" : "Error: " . $conn->error;
}

// Delete User
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['user_id'];

    $query = "DELETE FROM users WHERE user_id=$id";
    echo $conn->query($query) ? "User Deleted" : "Error: " . $conn->error;
}
?>
