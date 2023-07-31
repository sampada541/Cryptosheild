<?php
include 'connection.php';
include 'functions.php';
$id = strip_tags($_GET['encryptedKey']);

$card_number = '';
$err = "Invalid Encrypted Key";

if(isset($id)){


  $query = "SELECT * FROM `tbl_details` WHERE card_number = '$id'";
  $res = mysqli_query($conn,$query);

  if(mysqli_num_rows($res) >= 1){

    $row = mysqli_fetch_array($res);

    $card_number = my_simple_crypt($row['card_number'],'d');
    $expiry_date = my_simple_crypt($row['expiry_date'],'d');
    $cvv = my_simple_crypt($row['cvv'],'d');
    $card_name = $row['card_name'];

  }else{
    $err = 'Inavalid Encrypted Key';
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Decrypted User Information</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="a.png" alt="Logo">
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
	<li><a href="encryption.html">Encryption</a></li>
        <li><a href="decryption.html">Decryption</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
  <div class="popup" id="popupTable">
    <h1 style="color:yellow;">Decrypted User Information</h1>

  <!-- Popup table to show user data -->
  <?php
    if($card_number !== ''){ 
      ?>

<table>
      <tr>
        <th>Full Name</th>
        <th>Card Number</th>
        <th>Expiration Date</th>
        <th>CVV</th>
      </tr>
      <tr>
        <td id="popupFullName"><?=strip_tags($card_name)?></td>
        <td id="popupCardNumber"><?=strip_tags($card_number)?></td>
        <td id="popupExpiryDate"><?=strip_tags($expiry_date)?></td>
        <td id="popupCVV"><?=strip_tags($cvv)?></td>
      </tr>
    </table>

    <?php }else { ?>

      <h3 style="text-align:center">Invalid Encrypted Key</h3>

   <?php } ?>
    
  </div>
  
  </div>

</div>
<div>
</body>
</html>
