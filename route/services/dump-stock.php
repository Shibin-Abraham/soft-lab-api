<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($data->stockid,$data->current_date,$data->current_time)){
                $sql = "SELECT * FROM stock WHERE id=$data->stockid;";
                $stock_result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($stock_result)>0){
                    $stock_name;
                    while($row = mysqli_fetch_assoc($stock_result)){
                        $stock_name = $row['name'];
                    }
                    $name = $auth_result['name'];
                    $email = $auth_result['email'];
                    $sql = "INSERT INTO `recent_activities` (`id`, `name`, `email`, `date`, `time`, `details`, `operation`) VALUES (NULL, '$name', '$email', '$data->current_date', '$data->current_time', '$stock_name', 'dumped');";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        $sql = "UPDATE `stock` SET `dump` = '1' WHERE `id` = '$data->stockid';";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            $response = array(
                                "statuscode" => 200 // data dumped
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