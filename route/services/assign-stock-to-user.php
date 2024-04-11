<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($data->u_id,$data->s_id,$data->role)){
                $sql = "SELECT * FROM stock_handling_users WHERE u_id='$data->u_id' AND s_id='$data->s_id';";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $response = array(
                        "statuscode" => 403 //this user already take this stock
                    );
                    echo json_encode($response,JSON_PRETTY_PRINT);
                }else{
                    $sql = "INSERT INTO `stock_handling_users` (`id`, `u_id`, `s_id`, `role_name`) VALUES (NULL, '$data->u_id', '$data->s_id', '$data->role');";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        $response = array(
                            "statuscode" => 200 // success
                        );
                        echo json_encode($response,JSON_PRETTY_PRINT);
                    }else{
                        $response = array(
                            "statuscode" => 500 // internal server error
                        );
                        echo json_encode($response,JSON_PRETTY_PRINT);
                    }
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