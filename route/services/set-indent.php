<?php
include("../../config/constants.php");
include('../middleware/jwt-auth.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $allheaders = getallheaders();
    if(!empty($allheaders['Authorization'])){
        $auth_result = JWTStatus($allheaders['Authorization']);
        if($auth_result['statuscode'] === 200 && $auth_result['status'] === '1'){
            if(isset($_POST['stockId'],$_FILES['file']['name'])){
                $stockId = $_POST['stockId'];
                $image_name = $_FILES['file']['name'];
                if($image_name != ""){
                    $parts = explode('.',$image_name);
                    $ext = end($parts);//get the img extension eg:.png,.jpeg
                    $image_name = "soft-lab-indent-".$stockId.'.'.$ext;
                    $source_path = $_FILES['file']['tmp_name'];
                    $destination_path = "../../images/".$image_name;
                    $upload = move_uploaded_file($source_path,$destination_path);
                    if($upload){
                        $sql = "INSERT INTO `indent` (`id`, `s_id`, `img_name`) VALUES (NULL, '$stockId', '$image_name');";
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
                            "statuscode" => 406 // 406 file upload failed
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
    //$allheaders = getallheaders();
    //echo($_FILES['file']['name']);
    //echo $allheaders['Authorization'];
    //echo $_POST['stockId'];
}else{
    $response = array(
        "statuscode" => 400 // 400 bad request
    );
    echo json_encode($response,JSON_PRETTY_PRINT);
}

?>