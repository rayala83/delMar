<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
  $all_choferes = find_all('chofer');
  $all_patentes = find_all('camion');
  $all_proveedores = find_all('proveedores');
  
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_recurso($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'No encontrado';
        $html .= "</li>";

      }

      echo json_encode($html);
   }
 ?>
 <?php
 // find all product
  if(isset($_POST['p_name1']) && strlen($_POST['p_name1']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name1']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {

		
		  $html .= "<tr>";
		  
		  

          $html .= "<td id=\"chofer\">";
          $html .=   "<select class=\"form-control\" name=\"chofer\"> 
								<option value=\"\">Seleccione Chofer";
								foreach ($all_choferes as $ch):
								$html .= "<option value=\"".$ch['id']."\">".$ch['nombre']."";
								endforeach; 			
          $html  .= "</td>";				
		  
		  
          $html .= "<td id=\"patente\">";
          $html .=   "<select class=\"form-control\" name=\"patente\">  
								<option value=\"\">Seleccione Patente";
								foreach ($all_patentes as $pat):
								$html .= "<option value=\"".$pat['id']."\">".$pat['patente']."";
								endforeach; 
          $html  .= "</td>";
		  
		  $html .= "<td id=\"s_name\">".$result['name']."</td>";
		  
          $html  .= "<td>";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
          $html  .= "</td>";
		  
          $html  .= "</tr>";
		}	  
    } else {
        $html ='<tr><td>El producto no se encuentra registrado en la base de datos</td></tr>';
    }

    echo json_encode($html);
  }
 ?>		  
		  
		  
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {	

		  $html .= "<input type=\"hidden\" name=\"s_id\" value=\"{$result['id']}\">";
		
          $html .= "<tr>";

          $html .= "<td id=\"proveedor\">";
          $html .=   "<select class=\"form-control\" name=\"proveedor\">  
								<option value=\"\">Seleccione Proveedor";
								foreach ($all_proveedores as $prov):
								$html .= "<option value=\"".$prov['id']."\">".$prov['alias']."";
								endforeach; 
          $html  .= "</td>";
		  
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"text\" class=\"form-control\" name=\"quantity\" value=\"0\">";
          $html  .= "</td>";
		  
		  $html .= "<td id=\"calidad\">";
          $html .=   "<select class=\"form-control\" name=\"calidad\">  
								<option value=\"\">Seleccione Calidad
								<option value=\"B\">Bueno
								<option value=\"R\">Regular
								<option value=\"M\">Malo"; 
          $html  .= "</td>";
		  
		  $html .= "<td id=\"guia\">";
          $html .= "<input type=\"text\" class=\"form-control\" name=\"guia\" value=\"0\">";
          $html  .= "</td>";
		  
		  
          $html  .= "<td>";
          $html  .= "<button type=\"submit\" name=\"add_compra\" class=\"btn btn-primary\">Agregar</button>";
          $html  .= "</td>";
		  
          $html  .= "</tr>";

        }
    } else {
        $html ='<tr><td>El producto no se encuentra registrado en la base de datos</td></tr>';
    }

    echo json_encode($html);
  }
 ?>

		  