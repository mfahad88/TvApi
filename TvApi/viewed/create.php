<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/Database.php';

if (isset($_POST['id'])){
    $database=new Database();
    $conn=$database->getConnection();
    $sql="INSERT INTO viewed (channel_id) VALUES (".$_POST['id'].")";
        if ($conn->query($sql) === TRUE) {
            http_response_code(200);
            echo json_encode(array(message=>"New record created successfully"));
        } else {
            http_response_code(404);
            echo json_encode(array(message=>"Error: " . $sql . "<br>" . $conn->error));
        }
    
    $conn->close();
}else{
    http_response_code(503);
    echo json_encode(array(message=>"Invalid request"));
}