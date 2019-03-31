<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/Database.php';
class Region{
    public $Id;
    public $Name;
    public $Created_date;
}
$database=new Database();
$db=$database->getConnection();

$sql="SELECT * FROM region";
$result=$db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
   $obj=array();
    while($row = $result->fetch_assoc()) {
        $r=new Region();
        $r->Id=$row["region_id"];
        $r->Name=$row["name"];
        $r->Created_date=$row["created_date"];
        array_push($obj, $r);
    }
    http_response_code(200);
    echo json_encode($obj);
    
    

} else {
    http_response_code(503);
    echo "0 results";
}
$db->close();