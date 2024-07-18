<?php
$name=$_POST['cname'];
$adress=$_POST['caddress'];
$mobile=$_POST['cmobile'];
$balance=$_POST['cbalance'];


$servername='localhost';
$username= 'root';
$password= '';
$dbname= 'inventory';
try{

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die('failed to connect.'. $conn->connect_error);
  }else{

      $stmt=$conn->prepare("insert into customer(NAME,ADDRESS,MOBILE,BALANCE)VALUES(?,?,?,?)");
      $stmt->bind_param("ssii",$name,$adress,$mobile,$balance);
      $stmt->execute();
      echo"Successfully added!!!";
      $stmt->close();
      $conn->close();
  }
  
}catch(Exception $e){
echo $e->getMessage();
}
   



if($stmt== 1){
  header("Location:customer.php");
  echo'Success';
  
}


  

  ?>
