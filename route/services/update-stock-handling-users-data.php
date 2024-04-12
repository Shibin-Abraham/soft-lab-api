<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($data->id,$data->s_id,$data->role)){
                $sql = "UPDATE `stock_handling_users` SET `s_id` = '$data->s_id', `role_name` = '$data->role' WHERE `id` = '$data->id';";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $response = array(
                        "statuscode" => 200 // success
                    );
                    echo json_encode($response,JSON_PRETTY_PRINT);
                }else{
                    $response = array(
                        "statuscode" => 500 // 500 internal server error
                    );
                    echo json_encode($response,JSON_PRETTY_PRINT);
                }
            }else{
                $response = array(
                    "statuscode" => 400 // 400 bad request
                );
                echo json_encode($response,JSON_PRETTY_PRINT);
            }
        }else{
            $response = array(
                "statuscode" => 401 // 401 token expired
            );
            echo json_encode($response,JSON_PRETTY_PRINT); //token expired then login again
        }
    }else{
        $response = array(
            "statuscode" => 400 // 400 bad request
        );
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
    
?>