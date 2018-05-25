<?php
  $page_title = 'Agregar camiones';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>

<?php
	if (isset($_POST['add_camion'])){
		
		$req_fields = array('patente','modleo');
		validate_fields($req_fields);
		
		if(empty($errores)){
			$name	 = remove_junk($db->escape($_POST['patente']));
			$rut	 = remove_junk($db->escape($_POST['modelo']));
			
				$query = "INSERT INTO camion (";
				$query .= "patente,modelo";
				$query .=") VALUES (";
				$query .= " '{$name}', '{$rut}'";
				$query .= ")";
				if($db->query($query)){
				  //sucess
				  $session->msg('s'," Cuenta de usuario ha sido creada");
				  redirect('add_camion.php', false);
				} else {
				  //failed
				  $session->msg('d',' No se pudo crear la cuenta.');
				  redirect('add_camion.php', false);
				}
		   } else {
			 $session->msg("d", $errors);
			 redirect('add_camion.php',false);
		   }		
	}
?>		

<?php include_once('layouts/header.php'); ?>


 <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar camion</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_camion.php">
            <div class="form-group">
                <label for="name">Patente</label>
                <input type="text" class="form-control" name="patente" placeholder="Patente" required>
            </div>
            <div class="form-group">
                <label for="rut">Modelo</label>
                <input type="text" class="form-control" name="modelo" placeholder="Modelo">
            </div>


            <div class="form-group clearfix">
              <button type="submit" name="add_camion" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>





<?php include_once('layouts/footer.php'); ?>
