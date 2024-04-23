<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($data->id,$data->current_date,$data->current_time)){
                $sql = "SELECT * FROM item WHERE id=$data->id;";
                $stock_result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($stock_result)>0){
                    $item_name;
                    while($row = mysqli_fetch_assoc($stock_result)){
                        $item_name = $row['name'];
                    }
                    $name = $auth_result['name'];
                    $email = $auth_result['email'];
                    $sql = "INSERT INTO `recent_activities` (`id`, `name`, `email`, `date`, `time`, `details`, `operation`) VALUES (NULL, '$name', '$email', '$data->current_date', '$data->current_time', '$item_name', 'dumped');";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        $sql = "UPDATE `item` SET `dump` = '1' WHERE `id` = '$data->id';";
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