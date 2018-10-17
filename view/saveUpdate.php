<?php require '../config/db.php' ?>
<?php 
   
   $name = (isset($_FILES['img_name']['name'])? $_FILES['img_name']['name']:'');
   $tmp_name = (isset($_FILES['img_name']['tmp_name'])? $_FILES['img_name']['tmp_name']:'');
   $size =  (isset($_FILES['img_name']['size'])? $_FILES['img_name']['size']:'');
   $location = "../upload/";
   $max = 20000000;
   $extension = pathinfo($name,PATHINFO_EXTENSION);
   $valid_format = array("jpg","JPEG","jpeg","JPG", "png", "PNG");


   if(isset($emp_id) && !empty($emp_id)){
        $validate = $db->query("SELECT * FROM usuarios WHERE firstname = '".$fname."' AND lastname = '".$lname."' ");
           if($validate->rowCount() > 0){
                   $response = array("response" => "exist", "message" => "Por favor, faça alguma alteração ");
           }else{
          	    if(isset($name) && !empty($name)){
                       if(in_array($extension,$valid_format)){
                              if($size <= $max){
                                      if(move_uploaded_file($tmp_name, $location.$name)){
                                               $sql = $db->query("UPDATE usuarios SET firstname = '".$fname."', lastname = '".$lname."', address = '".$addr."', image_name = '".$name."' WHERE emp_id = '".$emp_id."'");
                                               if($sql){
                                               	$response = array("response" => "success", "message" => "Cadastro salvo com sucesso!!");
                                               }
                                      }else{
                                      	   $response = array("response" => "error", "message" => "Falha ao upar imagem");
                                      }
                              }else{
                                	$response = array("response" => "size", "message" => "Arquivo maior que 2MB !");
                              }
                       }else{
                       	  $response = array("response" => "invalid", "message" => "Formato inválido! ");
                       }
          	    }else {
                      $response = array("response" => "empty", "message" => "Por favor, selecione um arquivo!");
          	    }
           }
   }else{
   	    $validate = $db->query("SELECT * FROM usuarios WHERE firstname = '".$fname."' AND lastname = '".$lname."' ");
   	       if($validate->rowCount() > 0){
   	               $response = array("response" => "exist", "message" => "Esse nome e sobre nome já existe!");
   	       }else{
         	    if(isset($name) && !empty($name)){
                      if(in_array($extension,$valid_format)){
                             if($size <= $max){
                                     if(move_uploaded_file($tmp_name, $location.$name)){
                                            $sql = $db->query("INSERT INTO usuarios(firstname,lastname,address,image_name)VALUES('".$fname."','".$lname."','".$addr."','".$name."')");
                                              if($sql){
                                              	$response = array("response" => "success", "message" => "Salvo com sucesso!");
                                              }
                                     }else{
                                     	   $response = array("response" => "error", "message" => "Falha ao upar imagem");
                                     }
                             }else{
                               	$response = array("response" => "size", "message" => "Arquivo maior que 2MB !");
                             }
                      }else{
                      	  $response = array("response" => "invalid", "message" => "Formato inválido! ");
                      }
         	    }else {
                     $response = array("response" => "empty", "message" => "Por favor, selecione um arquivo!");
         	    }
   	       }    
   }
   echo json_encode($response);
?>