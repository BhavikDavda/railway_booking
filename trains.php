<?php
include 'config.php';

// Create Train
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $train_name = $_POST['train_name'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];

    $query = "INSERT INTO trains (train_name, source, destination, departure_time, arrival_time) VALUES ('$train_name', '$source', '$destination', '$departure_time', '$arrival_time')";
    echo $conn->query($query) ? "Train Added" : "Error: " . $conn->error;
}

// Read Trains
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM trains");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
}

// Update Train
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['train_id'];
    $train_name = $data['train_name'];
    $source = $data['source'];
    $destination = $data['destination'];
    $departure_time = $data['departure_time'];
    $arrival_time = $data['arrival_time'];

    $query = "UPDATE trains SET train_name='$train_name', source='$source', destination='$destination', departure_time='$departure_time', arrival_time='$arrival_time' WHERE train_id=$id";
    echo $conn->query($query) ? "Train Updated" : "Error: " . $conn->error;
}

// Delete Train
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['train_id'];

    $query = "DELETE FROM trains WHERE train_id=$id";
    echo $conn->query($query) ? "Train Deleted" : "Error: " . $conn->error;
}
?>
