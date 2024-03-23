<?php include("../config/constants.php");
$request = file_get_contents("php://input",true);
$data = json_decode($request);
if(isset($data->OTP,$data->sessionId)){
    session_id($data->sessionId);
    session_start();
    if(isset($_SESSION['otp'])){
        if($data->OTP == $_SESSION['otp']){
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            $name = $_SESSION['name'];
            $phone = $_SESSION['phone'];
            $date = date("Y-m-d");
            $role = 0;
            $status = 0;
            if($_SESSION['role']=="HOD"){
                $role = 1;
                $status = 1;
            }elseif($_SESSION['role']=='Manager'){
                $role = 2;
            }elseif($_SESSION['role']=='Assistent'){
                $role = 3;
            }
            $sql = "INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `join_date`,`status`,`r_id`) VALUES (NULL, '$name', '$email', '$password', '$phone', '$date','$status','$role');";
            $res = mysqli_query($conn,$sql);
            if($res == true){
                $response = array(
                    "statuscode"=>200, //200 ok
                    "email"=>$email
                    );
                echo json_encode($response,JSON_PRETTY_PRINT);
                session_destroy();
            }else{
                $response = array(
                    "statuscode"=>100 //100 oops
                    );
                echo json_encode($response,JSON_PRETTY_PRINT);
            }
        }else{
            $response = array(
                "statuscode"=>401 // invalid otp
                );
            echo json_encode($response,JSON_PRETTY_PRINT);
        }
    }else{
        $response = array(
            "statuscode"=>440 // session expired
            );
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}else{
    $response = array(
        "statuscode" => 400 //bad request
    );
    echo json_encode($response,JSON_PRETTY_PRINT);
}
?>