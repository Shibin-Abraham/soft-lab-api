<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    
    
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['r_id'] === '1'){ //r_id === 1 means the user is HOD
            //echo $data->status;
            //echo $data->u_id;
            if(isset($data->u_id)){
                $sql = "SELECT * FROM user WHERE id=$data->u_id";
                //$sql = "INSERT INTO `archive` (`id`, `name`, `email`, `phone`, `join_date`, `r_name`) VALUES (NULL, 'test', 'test@gmail.com', '9700220022', '2022-04-01', 'HOD');";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $i = 0;
                    $id;
                    $name;
                    $email;
                    $phone;
                    $join_date;
                    $r_name;
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $join_date = $row['join_date'];
                        if($row['r_id'] == 1){
                            $r_name = 'HOD';
                        }elseif($row['r_id'] == 2){
                            $r_name = 'Manager';
                        }elseif($row['r_id'] == 3){
                            $r_name = 'Assistant';
                        }
                        $i++; 
                    }
                    $sql = "INSERT INTO `archive` (`id`, `name`, `email`, `phone`, `join_date`, `r_name`) VALUES (NULL, '$name', '$email', '$phone', '$join_date', '$r_name');";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        $sql = "DELETE FROM user WHERE id=$id";
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