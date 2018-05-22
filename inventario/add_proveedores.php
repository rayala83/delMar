<?php
  $page_title = 'Agregar proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>

<?php
	if (isset($_POST['add_proveedor'])){
		
		$req_fields = array('name','rut','empresa','alias');
		validate_fields($req_fields);
		
		if(empty($errores)){
			$name	 = remove_junk($db->escape($_POST['name']));
			$rut	 = remove_junk($db->escape($_POST['rut']));
			$empresa = remove_junk($db->escape($_POST['empresa']));
			$alias	 = remove_junk($db->escape($_POST['alias']));
				$query = "INSERT INTO proveedores (";
				$query .= "nombre,rut,empresa,alias";
				$query .=") VALUES (";
				$query .= " '{$name}', '{$rut}', '{$empresa}', '{$alias}'";
				$query .= ")";
				if($db->query($query)){
				  //sucess
				  $session->msg('s'," Cuenta de usuario ha sido creada");
				  redirect('add_proveedores.php', false);
				} else {
				  //failed
				  $session->msg('d',' No se pudo crear la cuenta.');
				  redirect('add_proveedores.php', false);
				}
		   } else {
			 $session->msg("d", $errors);
			 redirect('add_proveedores.php',false);
		   }		
	}
?>		

<?php include_once('layouts/header.php'); ?>


 <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar Proveedor</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_proveedores.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" placeholder="Nombre completo" required>
            </div>
            <div class="form-group">
                <label for="rut">Rut</label>
                <input type="text" class="form-control" name="rut" placeholder="Rut del Proveedor">
            </div>
            <div class="form-group">
                <label for="empresa">Empresa</label>
                <input type="text" class="form-control" name ="empresa"  placeholder="Nombre de la Empresa">
            </div>
			<div class="form-group">
                <label for="alias">Usuario</label>
                <input type="text" class="form-control" name ="alias"  placeholder="Nombre de Usuario">
            </div>

            <div class="form-group clearfix">
              <button type="submit" name="add_proveedor" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>





<?php include_once('layouts/footer.php'); ?>
