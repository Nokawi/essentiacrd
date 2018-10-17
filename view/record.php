<?php require '../config/db.php' ?>



<?php 
    $limit = 3;
    $start = 0;
    $r = $db->query("SELECT COUNT(*) FROM usuarios");
    $total = $r->fetchColumn();
    $page = ($total/$limit);

    if(isset($id) && !empty($id)){
    	$id = $id;
    	$start = ($id - 1) * $limit;
    }else{
    	$id = 1;
    }
?>

<?php 
     $sql = "SELECT * FROM usuarios LIMIT ".$start.','.$limit;
 ?>
<?php $show = $db->query($sql); ?>
<table class="table table-sm" cellpadding="5">
	   <thead class="thead-dark">
	   	     <tr>
	   	     	 <th scope="col">#</th>
	   	     	 <th scope="col">ID</th>
	   	     	 <th scope="col">FOTO</th>
	   	     	 <th scope="col">NOME</th>
	   	     	 <th scope="col">ENDEREÇO</th>
	   	     	 <th scope="col">AÇÕES</th>
	   	     </tr>
	   </thead>
	   <tbody>
	   	      <?php if($show->rowCount() > 0 ){ ?>
                      <?php for($i=0;$row=$show->fetch(PDO::FETCH_OBJ);$i++){ ?>
                            <tr id="<?php echo $row->emp_id ?>">
                               <td><input type="checkbox" name="emp_id[]" id="emp_id" value="<?php echo $row->emp_id ?>"></td>
                            	 <td><?php echo $row->emp_id ?></td>
                            	 <td><img src="upload/<?php echo $row->image_name ?>" width="45" height="45  "></td>
                                 <td><?php echo ($row->firstname.','.$row->lastname) ?></td>
                                 <td><?php echo $row->address ?></td>
                                 <td>
                                <button type="button"  id="viewData" data-id="<?php echo $row->emp_id ?>" class="btn btn-dark">EDITAR</button>|
                                     <button type="button" id="deleteData" data-id="<?php echo $row->emp_id ?>" class="btn btn-danger">DELETAR</button>
                                 </td>
                            </tr>
                      <?php } ?>
	   	      <?php } else { ?>
                     <tr>
                     	 <td colspan="5">Sem registros</td>
                    </tr>
	   	       <?php }?>
	   </tbody>
</table>
<center>
<ul class="pagination">

	 <?php if($id > 1){ ?>
           <center><li><button type="button" class="btn btn-secondary" id="page-link" data-id="<?php echo ($id-1) ?>">Anterior</button></li></center>
	 <?php }else {
	 	   echo "<center><button class='btn btn-secondary' disabled>Anterior</button></center>";
	 }?>
	 
     

	 
      <?php for($i=1;$i <= $page;$i++){
      	if($id == $i){
              
      		     echo "<center><li class='active'>".$i."</li></center>";	
        	}else{
      			 echo "<center><li><a href='javascript:void(0)' class='active' data-id='".$i."' id='page-link'>".$i."</a></li></center>";
      			 
      	}    
      
      }?>	  


	  <?php if($page != $id){ ?>
          <center><li><button type="button" class="btn btn-secondary" id="page-link" data-id="<?php echo ($id+1) ?>">Proximo</button></li></center>
	 <?php }else {
	 	     echo "<center><button class='btn btn-secondary' disabled>Proximo</button></center>";
	 }?>
</ul>
</center>

<button type="button"id="multipleDelete" class="btn btn-danger">DELETAR SELECIONADOS</button>