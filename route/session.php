<?php
    function set_session($otp,$name,$email,$phone,$password,$role,$about){
        session_start();
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
    function get_session(){
        
    }
?>