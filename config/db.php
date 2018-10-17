<?php 
   extract($_POST);
   $servername = "localhost";
   $username = "db_essen";
   $password = "password";
   $database = "db_essen";
   $db = NULL;


   try{
          $db = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
          $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   }catch(PDOException $e){
          echo "no db found".$e->getMessage();
   }

?>
