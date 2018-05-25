<?php
  $page_title = 'Lista de Entradas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$entradas = find_all_entradas();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Todas la Entradas</span>
          </strong>
          <div class="pull-right">
            <a href="add_compra.php" class="btn btn-primary">Agregar Entrada</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Nombre del producto </th>
                <th class="text-center" style="width: 15%;"> Cantidad</th>
                <th class="text-center" style="width: 15%;"> Calidad </th>
                <th class="text-center" style="width: 15%;"> Chofer </th>
				<th class="text-center" style="width: 15%;"> Patente </th>
				<th class="text-center" style="width: 15%;"> Fecha </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($entradas as $entrada):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($entrada['name']); ?></td>
               <td class="text-center"><?php echo (int)$entrada['cantidad']; ?></td>
               <td class="text-center"><?php echo remove_junk($entrada['calidad']); ?></td>
			   <td class="text-center"><?php echo remove_junk($entrada['nombre']); ?></td>
               <td class="text-center"><?php echo remove_junk($entrada['patente']); ?></td>
               <td class="text-center"><?php echo $entrada['fecha']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$entrada['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_sale.php?id=<?php echo (int)$entrada['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
