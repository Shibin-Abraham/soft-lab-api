<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1' && $auth_result['r_id'] === '1'){
            $sql = "SELECT * FROM stock ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $stock_id = $row['id'];
                    $sql = "SELECT * FROM indent WHERE s_id=$stock_id";
                    $indent_result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($indent_result)==0){
                            $response[$i]['id'] = $row['id'];
                            $response[$i]['name'] = $row['name'];
                            $response[$i]['type'] = $row['type'];
                            $response[$i]['category'] = $row['category'];
                            $response[$i]['invoice_id'] = $row['invoice_id'];
                            $response[$i]['invoice_date'] = $row['invoice_date'];
                            $response[$i]['supplier_name'] = $row['supplier_name'];
                            $response[$i]['dump'] = $row['dump'];
                            $i++; 
                    }   
                }
            }
            echo json_encode($response,JSON_PRETTY_PRINT);
        }else if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1' && $auth_result['r_id'] !== '1'){
            $u_id = $auth_result['u_id'];
            $sql = "SELECT * FROM stock_handling_users WHERE u_id = '$u_id';";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $s_id = $row['s_id'];
                    $sql2 = "SELECT * FROM `stock` WHERE id='$s_id';";
                    $result2 = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result2)==1){
                        $row2 = mysqli_fetch_row($result2);
                        $stock_id = $row2[0];
                        $sql = "SELECT * FROM indent WHERE s_id=$stock_id";
                        $indent_result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($indent_result)==0){ 
                            $response[$i]['id'] = $row2[0];
                            $response[$i]['name'] = $row2[1];
                            $response[$i]['type'] = $row2[2];
                            $response[$i]['category'] = $row2[3];
                            $response[$i]['invoice_id'] = $row2[4];
                            $response[$i]['invoice_date'] = $row2[5];
                            $response[$i]['supplier_name'] = $row2[6];
                            $response[$i]['dump'] = $row2[7];
                            $i++;
                        }
                    }
                    
                }
                echo json_encode($response,JSON_PRETTY_PRINT);
            }else{
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