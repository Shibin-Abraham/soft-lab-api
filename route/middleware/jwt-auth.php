<?php 
require '../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\key;
use Firebase\JWT\ExpiredException;

function JWTStatus($token){
    try{
        $secret = "soft_lab@123";
        $user_obj = JWT::decode($token,new Key($secret, 'HS256'));
        $response = array(
            "statuscode" => 200, // 200 token successfully verified
            'u_id' => $user_obj->data->u_id,
            'email'=> $user_obj->data->email,                  
            'name' => $user_obj->data->name,
            'phone' => $user_obj->data->phone,
            'join_date' =>$user_obj->data->join_date,
            'status' => $user_obj->data->status,
            'r_id' => $user_obj->data->r_id,
            'r_name' => $user_obj->data->r_name,
        );
        return $response;
    }catch(Exception $e){
        //echo "access denied",$e->getMessage();
        $response = array(
            "statuscode" => 401 // 401 token expired
        );
        return $response;
    }
}

?>