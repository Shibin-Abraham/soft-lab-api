<?php 
include("../../config/constants.php");
include('./jwt-auth.php');

$request = file_get_contents("php://input",true);
$data = json_decode($request);
if(isset($data->JWT)){
        $res = JWTStatus($data->JWT);
        echo json_encode($res,JSON_PRETTY_PRINT);
}else{
    $response = array(
        "statuscode" => 401 // 401 token expired
    );
    echo json_encode($response,JSON_PRETTY_PRINT);
}
?>
