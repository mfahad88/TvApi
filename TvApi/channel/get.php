<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
//header("Content-type: image/png"); 

include_once '../config/Database.php';

class Channel {
    public $channel_id;
    public $cat_id;
    public $region_id;
    public $name;
    //public $icon;
    public $url;
    public $is_enable;
    public $Created_date;
}
$database=new Database();
$db=$database->getConnection();

$sql="SELECT * FROM channels";
$result=$db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $obj=array();
    while($row = $result->fetch_assoc()) {
        $c=new Channel();
        $c->channel_id=$row["channel_id"];
        $c->cat_id=$row["cat_id"];
        $c->region_id=$row["region_id"];
        $c->name=$row["name"];
        //$c->icon=$row["icon"];
        $c->url=$row["url"];
        $c->is_enable=$row["is_enable"];
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
