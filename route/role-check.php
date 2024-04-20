<?php include("../config/constants.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "SELECT r_id FROM user WHERE r_id=1";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)==0){
        $response = array("HOD","Manager","Assistent");
        echo json_encode($response,JSON_PRETTY_PRINT);
    }else{
        $response = array( "Manager", "Assistant");
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}else{
    http_response_code(400);//bad request so change responce header
}
?>