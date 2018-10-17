<?php require '../config/db.php'; ?>
<?php 
   if(isset($emp_id) && !empty($emp_id)){
   	    $sql = $db->query("SELECT * FROM usuarios WHERE emp_id = '".$emp_id."' ");
   	    if($sql){
   	    	    echo json_encode(array($sql->fetch(PDO::FETCH_ASSOC)));
   	    }
   }
?>