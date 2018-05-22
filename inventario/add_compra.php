<?php
  $page_title = 'Agregar Entrada';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>

<?php

  if(isset($_POST['add_compra'])){
    $req_fields = array('s_id','proveedor','price','quantity','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
		  $proov	 = $db->escape($_POST['proveedor']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO compras (";
          $sql .= " product_id, proveedor_id, cantidad, fecha";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$proov}','{$s_qty}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty_edit($s_qty,$p_id);
                  $session->msg('s',"Compra Agregada ");
                  redirect('add_compra.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('add_compra.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_compra.php',false);
        }
  }

?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax3.php" autocomplete="off" id="sug-form3">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input3" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
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
          <span>Agregar Entrada</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_compra.php">
		 <table class="table table-bordered">
           <thead>
            <th> Chofer </th>
            <th> Patente </th>
			<th> Produto </th>
			<th> Fecha</th>
           </thead>
             <tbody  id="camion_info"> </tbody>
         </table>		
		
         <table id="lista_productos" class="table table-bordered">
           <thead>
            <th> Proovedor </th>            
            <th> Cantidad </th>
            <th> Calidad</th>    
			<th> Guia o Factura</th> 
			<th> Acciones</th>
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>


     </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions2.js"></script>
  </body>
</html>

<?php if(isset($db)) { $db->db_disconnect(); } ?>