<?php include("../../config/constants.php");
    include('../middleware/jwt-auth.php');

    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            $sql = "SELECT * FROM `item` ORDER BY warranty";
            $result = mysqli_query($conn,$sql);
            $response = array();
            function get_brand_name($brand_id){
                $sql = "SELECT * FROM brand";
                global $conn;
                $result2 = mysqli_query($conn,$sql);
                $res = '';
                if(mysqli_num_rows($result2)>0){
                    while($row2 = mysqli_fetch_assoc($result2)){
                        if($row2['id']==$brand_id){
                            $res = $row2['name'];
                        }
                    }
                    return $res;
                }else{
                    return $res;
                }
                
            }
            if(mysqli_num_rows($result)>0){
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    if($row['dump']==0){
                        $response[$i]['id'] = $row['id'];
                        $response[$i]['name'] = $row['name'];
                        $response[$i]['warranty'] = $row['warranty'];
                        $response[$i]['brand_name'] = get_brand_name($row['brand_id']);
                    }
                    $i++; 
                }
            }else{
                $response = array();
                $response[0]['statuscode'] = 204; // 204 no content
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