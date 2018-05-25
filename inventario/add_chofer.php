<?php
  $page_title = 'Agregar chofer';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>

<?php
	if (isset($_POST['add_chofer'])){
		
		$req_fields = array('nombre','empresa');
		validate_fields($req_fields);
		
		if(empty($errores)){
			$name	 = remove_junk($db->escape($_POST['nombre']));
			$rut	 = remove_junk($db->escape($_POST['empresa']));
			
				$query = "INSERT INTO chofer (";
				$query .= "nombre,empresa";
				$query .=") VALUES (";
				$query .= " '{$name}', '{$rut}'";
				$query .= ")";
				if($db->query($query)){
				  //sucess
				  $session->msg('s'," Cuenta de usuario ha sido creada");
				  redirect('add_chofer.php', false);
				} else {
				  //failed
				  $session->msg('d',' No se pudo crear la cuenta.');
				  redirect('add_chofer.php', false);
				}
		   } else {
			 $session->msg("d", $errors);
			 redirect('add_chofer.php',false);
		   }		
	}
?>		

<?php include_once('layouts/header.php'); ?>


 <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar chofer</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_chofer.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Agregue Nombre" required>
            </div>
            <div class="form-group">
                <label for="rut">Empresa</label>
                <input type="text" class="form-control" name="empresa" placeholder="Agregue empresa">
            </div>


            <div class="form-group clearfix">
              <button type="submit" name="add_chofer" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>





<?php include_once('layouts/footer.php'); ?>
