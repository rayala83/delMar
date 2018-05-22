<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
	
  if(isset($_POST['add_sale_contenedor'])){
	$req_fields = array('s_id','cantidad','contenedor','lote','calidad', 'glaseado', 'date' );
	validate_fields($req_fields);
		if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
		  $s_qty     = $db->escape((int)$_POST['cantidad']);
          $cont    	 = $db->escape($_POST['contenedor']);
          $lote      = $db->escape($_POST['lote']);
		  $calidad   = $db->escape($_POST['calidad']);
		  $glaseado  = $db->escape($_POST['glaseado']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO contenedor (";
          $sql .= " product_id,cantidad,num_contenedor,lote,calidad,glaseado,fecha";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$cont}','{$lote}','{$calidad}','{$glaseado}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Agregada a Contenedor ");
                  redirect('add_sale_contenedor.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('add_sale_contenedor.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale_contenedor.php',false);
        }

}	
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax2.php" autocomplete="off" id="sug-form2">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input2" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Contenedor</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale_contenedor.php">
         <table class="table table-bordered">
           <thead>
			<tr>
				<th> Producto </th>
				<th> Cantidad </th>
				<th> Contenedor </th>
				<th> Lote </th>
			</tr>
		   </thead>
			 <tbody  id="product_info"> </tbody>
		 </table>	
		 
		 <table class="table table-bordered">		 
		   <thead>
			<tr>	
				<th> Calidad </th>
				<th> Glaseado </th>
				<th> Fecha</th>
				<th> Acciones</th>
			</tr>	
           </thead> 
			 <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>