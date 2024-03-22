<?php
include("../config/constants.php");
$request = file_get_contents("php://input",true);
$data = json_decode($request);
if($request!== false && isset($data->name,$data->email,$data->phone,$data->password,$data->passwordrepeat,$data->position)){
    $name = test_input($data->name);
    $email = test_input($data->email);
    $phone = test_input($data->phone);
    $password = test_input($data->password);
    $password = password_hash($password,PASSWORD_DEFAULT); //encode password
    $passwordrepeat = test_input($data->passwordrepeat);
    $position = test_input($data->position);
    if(password_verify($passwordrepeat,$password)){
        if($db_conn){
            $sql = "SELECT email FROM user WHERE email='$email'";
            $res = mysqli_query($conn,$sql);
            if(mysqli_num_rows($res)==0){
                $to_email = $email;
                $otp = rand(100000,999999); 
                $subject = "Email Verification";
                $body = "Dear $name, Your One Time Password (OTP) is $otp ,Do not share this OTP with anyone.\nThis is an auto-generated e-mail and please do not reply.";
                $headers = "From:"." Soft Lab Supporting Team";
                if (mail($to_email, $subject, $body, $headers)) {
                    $id = session_create_id();
                    session_id($id);
                    session_start();
                    $_SESSION['otp'] = $otp;
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['password'] = $password;
                    $_SESSION['role'] = $position;
                    $response = array(
                        "statuscode" => 200,
                        "sessionID" =>$id// otp sended to corresponding email
                    );
                    echo json_encode($response,JSON_PRETTY_PRINT);
                } else{
                    header('HTTP/1.1 200');
                    $response = array(
                        "statuscode" => 424 // email sending faild
                    );
                    echo json_encode($response,JSON_PRETTY_PRINT);
                }
            }else{
                header('HTTP/1.1 200');
                $response = array(
                    "statuscode" => 403 //email already exist
                );
                echo json_encode($response,JSON_PRETTY_PRINT);
            }
        }else{
            header('HTTP/1.1 200');
            $response = array(
                "statuscode" => 503 //503 server under maintanance
            );
            echo json_encode($response,JSON_PRETTY_PRINT);
            
        }
    }else{
        header('HTTP/1.1 200');
        $response = array(
            "statuscode" => 401 //password should match
        );
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}else{
    header('HTTP/1.1 200');
        $response = array(
            "statuscode" => 400 
        );
        echo json_encode($response,JSON_PRETTY_PRINT);
}


// test input function return clean(remove the unwanted contents) data
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    function set_session($otp,$name,$email,$phone,$password,$role,$about){
        if($about == 1){
            $res=[$_SESSION['otp'],$_SESSION['name'],$_SESSION['email'],$_SESSION['phone'],$_SESSION['password'],$_SESSION['role']];
            return $res;
        }
        $_SESSION['otp'] = $otp;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = $role;
    }

?>