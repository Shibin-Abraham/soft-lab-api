<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');

    header('Content-type:JSON');
    
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['r_id'] === '1'){ //r_id === 1 means the user is HOD
            //echo $data->status;
            //echo $data->u_id;
            if(isset($data->status,$data->u_id)){
                $status = $data->status == 'Assign'?"1":"0";
                $sql = "UPDATE user SET status = '$status' WHERE id = $data->u_id;";
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