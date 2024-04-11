<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');
    header('Content-type:JSON');
    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            $sql = "SELECT * FROM stock ORDER BY id DESC";
            $result = mysqli_query($conn,$sql);
            $response = array();
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
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