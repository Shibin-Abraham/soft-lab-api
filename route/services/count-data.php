<?php include("../../config/constants.php");
    if(isset($_GET['id'])){
        if($_GET['id'] == 1){
            $sql = "SELECT COUNT(id) AS count FROM stock WHERE dump=0";
            $res = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($res);
            $active_stock =  $data['count'];
            $sql = "SELECT COUNT(id) AS count FROM stock";
            $res = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($res);
            $total_stock = $data['count'];
            $count = ($active_stock/$total_stock)*100;
            $response = array(
                "statuscode" => 200, //success
                "percentage" => (int) $count,
                "count" => $active_stock,
                "total" => $total_stock
            );
            echo json_encode($response,JSON_PRETTY_PRINT);
        }elseif($_GET['id'] == 2){
            $sql = "SELECT COUNT(id) AS count FROM item WHERE dump=0";
            $res = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($res);
            $active_item =  $data['count'];
            $sql = "SELECT COUNT(id) AS count FROM item";
            $res = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($res);
            $total_item = $data['count'];
            $count = ($active_item/$total_item)*100;
            $response = array(
                "statuscode" => 200, //success
                "percentage" => (int) $count,
                "count" =>$active_item,
                "total" => $total_item
            );
            echo json_encode($response,JSON_PRETTY_PRINT);
        }elseif($_GET['id'] == 3){
            $sql = "SELECT COUNT(id) AS count FROM borrowers WHERE return_status = 0";
            $res = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($res);
            $no_of_borrower = $data['count'];
            $sql = "SELECT COUNT(id) AS count FROM item WHERE dump=0";
            $res = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($res);
            $active_item =  $data['count'];
            $count = ($no_of_borrower/$active_item)*100;
            $response = array(
                "statuscode" => 200, //success
                "percentage" => (int) $count,
                "count" => $no_of_borrower,
                "total" => $active_item
            );
            echo json_encode($response,JSON_PRETTY_PRINT);
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
?>