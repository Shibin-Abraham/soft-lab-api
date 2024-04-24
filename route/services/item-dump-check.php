<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($data->id)){
                $sql = "SELECT * FROM `borrowers` WHERE item_id=$data->id AND return_status=0";//return_status = 0 means item not returned
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)===1){
                    $response = array(
                        "statuscode" => 409 // cant dump this item present in borrower table
                    );
                    echo json_encode($response,JSON_PRETTY_PRINT);
                }else{
                    $response = array(
                        "statuscode" => 200 // success means the item can dump
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