<?php 
   extract($_POST);
   $servername = "localhost";
   $username = "u684894365_essen";
   $password = "essentia123";
   $database = "u684894365_essen";
   $db = NULL;


   try{
          $db = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
          $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   }catch(PDOException $e){
          echo "no db found".$e->getMessage();
   }

?>
