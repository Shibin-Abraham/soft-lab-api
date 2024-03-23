<?php include("../config/constants.php");
    require '../vendor/autoload.php';

    use Firebase\JWT\JWT;

    $request = file_get_contents("php://input",true);
    $data = json_decode($request);
    if(isset($data->email,$data->password)){
        $email = test_input($data->email);
        $sql = "SELECT * FROM user WHERE email='$email'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res) == 1){
            $password = $data->password;
            $row = mysqli_fetch_row($res);
            $u_id = $row[0];
            $name = $row[1];
            $email = $row[2];
            $h_password = $row[3];
            $phone = $row[4];
            $join_date = $row[5];
            $status = $row[6];
            $r_id = $row[7];
            $sql2 = "SELECT * FROM role WHERE id='$r_id'";
            $res2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_row($res2);
            $r_name = $row2[1];
            if(password_verify($password,$h_password)){
                $response = array(
                    "statuscode" => 200,
                    "JWT" => generateJWT($u_id,$name,$email,$phone,$join_date,$status,$r_id,$r_name) //user defined function return jwt token
             );
             echo json_encode($response,JSON_PRETTY_PRINT);
            }else{
                $response = array(
                    "statuscode" => 401, // Invalid password
                    "password" => true
                );
                echo json_encode($response,JSON_PRETTY_PRINT);
            }
        }else{
            $response = array(
                "statuscode" => 401 // Invalid email
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
function generateJWT($u_id,$name,$email,$phone,$join_date,$status,$r_id,$r_name){
    $secret_key = "soft_lab@123";
    $payload = [
           'iss'=>'localhost',
           'aud'=>'localhost',
           'exp'=>time()+10000,
           'data'=>[
                'u_id' => $u_id,
                'email' => $email,
                'name' => $name,
                'phone' => $phone,
                'join_date' => $join_date,
                'status' => $status,
                'r_id' => $r_id,
                'r_name' => $r_name
           ],
           ];
    $jwt = JWT::encode($payload,$secret_key,'HS256');
    return $jwt;
}
?>