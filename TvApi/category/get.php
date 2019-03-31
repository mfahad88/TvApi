<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/Database.php';

    class Category {
        public $cat_id;
//         public $region_id;
        public $name;
        public $Created_date;
    }
    $database=new Database();
    $db=$database->getConnection();
    
    $sql="SELECT * FROM category";
    $result=$db->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $obj=array();
        while($row = $result->fetch_assoc()) {
            $c=new Category();
            $c->cat_id=$row["cat_id"];
//             $c->region_id=$row["region_id"];
            $c->name=$row["name"];
            $c->Created_date=$row["created_date"];
            array_push($obj, $c);
        }
        http_response_code(200);
        echo json_encode($obj);
        
        
        
    } else {
        http_response_code(503);
        echo "0 results";
    }
    $db->close();
