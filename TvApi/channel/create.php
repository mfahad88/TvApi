<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/Database.php';

if ((isset($_POST['cat_id'])) && (isset($_POST['region_id'])) && (isset($_POST['name']))){
    $database=new Database();
    $conn=$database->getConnection();
    $check = getimagesize($_FILES["icon"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['icon']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        
        
        $sql="INSERT INTO channels(region_id, cat_id, name, icon, url, is_enable) VALUES (".$_POST('region_id').",".$_POST['cat_id'].",".$_POST['name'].",'".base64_encode($imgContent)."','1')";
    if ($conn->query($sql) === TRUE) {
        http_response_code(200);
        echo json_encode(array(message=>"New record created successfully"));
    } else {
        http_response_code(404);
        echo json_encode(array(message=>"Error: " . $sql . "<br>" . $conn->error));
    }
    }
    $conn->close();
}else{
    http_response_code(503);
    echo json_encode(array(message=>"Invalid request"));
}