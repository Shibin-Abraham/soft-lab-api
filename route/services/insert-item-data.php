<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($data->itemno,$data->stockid,$data->brandId,$data->model,$data->description,$data->wdate,$data->Itype,$data->location,$data->status,$data->totalprice,$data->date,$data->time)){
                $sql = "INSERT INTO `item` (`id`, `name`, `model`, `description`, `warranty`, `type`, `lab_location`, `status`, `amount`, `dump`, `s_id`, `brand_id`) VALUES (NULL, '$data->itemno', '$data->model', '$data->description', '$data->wdate', '$data->Itype', '$data->location', '$data->status', '$data->totalprice', '0', '$data->stockid', '$data->brandId');";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $name = $auth_result['name'];
                    $email = $auth_result['email'];
                    $sql = "INSERT INTO `recent_activities` (`id`, `name`, `email`, `date`, `time`, `details`, `operation`) VALUES (NULL, '$name', '$email', '$data->date', '$data->time', '$data->itemno', 'added');";
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