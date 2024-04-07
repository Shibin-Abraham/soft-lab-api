<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');

    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            $sql = "SELECT id,name,email,phone,join_date,status,r_id FROM user";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $response[$i]['id'] = $row['id'];
                    $response[$i]['name'] = $row['name'];
                    $response[$i]['email'] = $row['email'];
                    $response[$i]['phone'] = $row['phone'];
                    $response[$i]['join_date'] = $row['join_date'];
                    $response[$i]['status'] = $row['status'];
                    $response[$i]['r_id'] = $row['r_id'];
                    if($row['r_id'] == 1){
                        $response[$i]['r_name'] = 'HOD';
                    }elseif($row['r_id'] == 2){
                        $response[$i]['r_name'] = 'Lab Manager';
                    }elseif($row['r_id'] == 3){
                        $response[$i]['r_name'] = 'Lab Assistant';
                    }
                    $i++; 
                }
            }
            echo json_encode($response,JSON_PRETTY_PRINT);
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