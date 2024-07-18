<?php
  $servername='localhost';
  $username= 'root';
  $password= '';
  $dbname= 'inventory';
try{

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die('failed to connect.'. $conn->connect_error);
    }else{

        echo" ";
    }
    
}catch(Exception $e){
echo $e->getMessage();
}

  

?>