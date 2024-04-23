<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1' && $auth_result['r_id'] === '1'){
            $sql = "SELECT * FROM item WHERE dump=1 ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $stock_id = $row['s_id'];
                    $sql = "SELECT * FROM stock WHERE id='$stock_id'";
                    $stock_result = mysqli_query($conn,$sql);
                    $brand_id = $row['brand_id'];
                    $sql2 = "SELECT * FROM brand WHERE id='$brand_id'";
                    $brand_result = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($stock_result)==1&&mysqli_num_rows($brand_result)==1){
                        $stock_row = mysqli_fetch_row($stock_result);
                        $brand_row = mysqli_fetch_row($brand_result);
                        $response[$i]['id'] = $row['id'];
                        $response[$i]['name'] = $row['name'];
                        $response[$i]['model'] = $row['model'];
                        $response[$i]['description'] = $row['description'];
                        $response[$i]['warranty'] = $row['warranty'];
                        $response[$i]['type'] = $row['type'];
                        $response[$i]['lab_location'] = $row['lab_location'];
                        $response[$i]['status'] = $row['status'];
                        $response[$i]['amount'] = $row['amount'];
                        $response[$i]['dump'] = $row['dump'];
                        $response[$i]['s_id'] = $stock_row[0];
                        $response[$i]['s_name'] = $stock_row[1];
                        $response[$i]['b_id'] = $brand_row[0];
                        $response[$i]['b_name'] = $brand_row[1];
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
                        //$stock_id = $stock_row[0];
                        $sql3 = "SELECT * FROM item WHERE dump=1 AND s_id=$stock_id";
                        $items_result = mysqli_query($conn, $sql3);
                        while($item_row = mysqli_fetch_assoc($items_result)){
                            $brand_id = $item_row['brand_id'];
                            $sql2 = "SELECT * FROM brand WHERE id='$brand_id'";
                            $brand_result = mysqli_query($conn,$sql2);
                            $brand_row = mysqli_fetch_row($brand_result);
                            if(mysqli_num_rows($brand_result)!=0){
                                $response[$i]['id'] = $item_row['id'];
                                $response[$i]['name'] = $item_row['name'];
                                $response[$i]['model'] = $item_row['model'];
                                $response[$i]['description'] = $item_row['description'];
                                $response[$i]['warranty'] = $item_row['warranty'];
                                $response[$i]['type'] = $item_row['type'];
                                $response[$i]['lab_location'] = $item_row['lab_location'];
                                $response[$i]['status'] = $item_row['status'];
                                $response[$i]['amount'] = $item_row['amount'];
                                $response[$i]['dump'] = $item_row['dump'];
                                $response[$i]['s_id'] = $stock_row[0];
                                $response[$i]['s_name'] = $stock_row[1];
                                $response[$i]['b_id'] = $brand_row[0];
                                $response[$i]['b_name'] = $brand_row[1];
                                $i++;
                            }
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