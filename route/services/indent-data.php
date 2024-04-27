<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1' && $auth_result['r_id'] === '1'){
            $sql = "SELECT * FROM indent ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $item_id = $row['id'];
                    $stock_id = $row['s_id'];
                    $sql = "SELECT * FROM stock WHERE id='$stock_id'";
                    $stock_result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($stock_result)==1){
                        $stock_row = mysqli_fetch_row($stock_result);
                        $img_path =  SITEURL.$row['img_name'];
                        $response[$i]['id'] = $row['id'];
                        $response[$i]['s_id'] = $row['s_id'];
                        $response[$i]['img_name'] = $img_path;
                        $response[$i]['stock_id'] = $stock_row[0];
                        $response[$i]['stock_name'] = $stock_row[1];
                        $i++;
                    } 
                }
            }
            echo json_encode($response,JSON_PRETTY_PRINT);
        }elseif($auth_result['statuscode'] === 200 && $auth_result['status'] === '1' && $auth_result['r_id'] !== '1'){ //this for manager and assistant
            $u_id = $auth_result['u_id'];
            $sql = "SELECT * FROM `stock_handling_users` WHERE u_id=$u_id";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $stock_id = $row['s_id'];
                    $sql = "SELECT * FROM stock WHERE id='$stock_id'";
                    $stock_result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($stock_result)!=0){
                        $stock_row = mysqli_fetch_row($stock_result);
                        $sql3 = "SELECT * FROM indent WHERE s_id=$stock_id";
                        $indent_result = mysqli_query($conn, $sql3);
                        while($indent_row = mysqli_fetch_assoc($indent_result)){
                            $img_path =  SITEURL.$indent_row['img_name'];
                            $response[$i]['id'] = $indent_row['id'];
                            $response[$i]['s_id'] = $indent_row['s_id'];
                            $response[$i]['img_name'] = $img_path;
                            $response[$i]['stock_id'] = $stock_row[0];
                            $response[$i]['stock_name'] = $stock_row[1];
                            $i++;
                        }    
                    } 
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