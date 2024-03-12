<?php

$data = $_POST;
$mac_provided = $data['mac'];
unset($data['mac']);
$ver = explode('.' , phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >=5 and $minor >=4){
    ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
    uksort($data, 'strcasecmp');
}

$mac_calculated = hash_hmac("sha1",implode("|", $data), "<YOUR_SALT>");
if($mac_provided == $mac_calculated){
    if($data['status'] == "Credit"){

        include 'config_shop.php';

        $total_product=$data['description'];
        $total_price=$data['amount'];
        $name=$data['name'];
        $email=$data['email'];
        $number=$data['contact'];
        $pid=$data['id'];
        $status=$data['status'];

        sql = "INSERT INTO `order`($total_product, total_price, name, email, number, pid, status) VALUES('$total_product, $total_price, $name, $email, $number, $pid, $status) ";
        mysqli_query($conn,$sql);


    }
    else{

    }
}
else{
    echo "MAC mismatch";
}


?>