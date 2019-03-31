<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-type: image/jpg,image/png"); 

if(isset($_GET['id'])){
    include_once '../config/Database.php';
    
    
    $database=new Database();
    $db=$database->getConnection();
    
    $sql="SELECT * FROM category where cat_id=".$_GET['id'];
    $result=$db->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo $row['icon'];
            
        }
        
    } else {
        http_response_code(503);
        echo "0 results";
    }
    $db->close();
    
}