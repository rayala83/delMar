<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_title($_POST['product_name']);
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
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {

		  $html	.= "<div class=\"form-group\">";
		  
          $html .= "<div class=\"row\">";

		  $html .= "<div class=\"col-md-3\" id=\"s_name\">".$result['name']."</div>";
          $html .= "<input type=\"hidden\" name=\"s_id\" value=\"{$result['id']}\">";
		  
          $html  .= "<div class=\"col-md-3\" id=\"cantidad\">";
          $html  .=  "<input type=\"text\" class=\"form-control\" name=\"cantidad\" value=\"{$result['quantity']}\">";
          $html  .= "</div>";
		  
          $html .= "<div class=\"col-md-3\" id=\"contenedor\">";
          $html .= "<input type=\"number\" class=\"form-control\" name=\"contenedor\" min=\"1\" max=\"6\">";
          $html  .= "</div>";
		  
          $html  .= "<div class=\"col-md-3\" id=\"lote\">";
          $html  .=  "<input type=\"text\" class=\"form-control\" name=\"lote\" value=\"1\">";
          $html  .= "</div>";
		  
		  $html  .= "</div>";
		  $html  .= "</div>";
		  
       }
    } else {
        $html ='<div><div>El producto no se encuentra registrado en la base de datos</div></div>';
    }

    echo json_encode($html);
  }
 ?>		  
		  
 <?php
 // find all product
  if(isset($_POST['p_name2']) && strlen($_POST['p_name2']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name2']));
    if($results = find_all_product_info_by_title($product_title)){
        foreach ($results as $result) {		  
		  
		  $html	.= "<div class=\"form-group\">";
		  
          $html .= "<div class=\"row\">";
		  
		  $html .= "<div class=\"col-md-3\" id=\"calidad\">";
          $html .= "<select class=\"form-control\" name=\"calidad\">  
								<option value=\"\">Seleccione Calidad
								<option value=\"B\">Bueno
								<option value=\"R\">Regular
								<option value=\"M\">Malo"; 
          $html  .= "</div>";			  
		  
		  
		  $html .= "<div class=\"col-md-3\" id=\"glaseado\">";
          $html .= "<input type=\"number\" class=\"form-control\" name=\"glaseado\" min=\"0\" max=\"100\" step=\"10\"value=\"0\">";
          $html  .= "</div>";
		  
          $html  .= "<div class=\"col-md-3\">";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
          $html  .= "</div>";
		  
          $html  .= "<div class=\"col-md-3\">";
          $html  .= "<button  type=\"submit\" name=\"add_sale_contenedor\" class=\"btn btn-primary\">Agregar</button>";
          $html  .= "</div>";
		  
          $html  .= "</div>";
		  $html  .= "</div>";



        }
    } else {
        $html ='<div><div>El producto no se encuentra registrado en la base de datos</div></div>';
    }

    echo json_encode($html);
  }
 ?>
