<?php

include 'connection.php';
include 'functions.php';


if(!empty($_POST)){

    $created_on = date('d-m-Y h:i:sa');
    $card_number = my_simple_crypt(mysqli_real_escape_string($conn,$_POST['cardNumber']),'e');
    $card_name = mysqli_real_escape_string($conn,$_POST['cardName']);
    $expiry_date = my_simple_crypt(mysqli_real_escape_string($conn,$_POST['expiryDate']),'e');
    $cvv = my_simple_crypt(mysqli_real_escape_string($conn,$_POST['cvv']),'e');
    //$password_enc=my_simple_crypt(mysqli_real_escape_string($conn,$_POST['password']),'e');

    $query = "INSERT INTO `tbl_details`( `card_number`, `card_name`, `expiry_date`, `cvv`, `created_on`) 
                VALUES ('$card_number','$card_name','$expiry_date','$cvv','$created_on')";
      
    if(mysqli_query($conn,$query)){
        echo 'success';
    }else{
        echo 'err';
    }
}  

?>