<?php
ob_start();
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $item = $db->getItemsById($id);
  $cat = $db->getCategoryByItemToShow($id);
  //print_r($cat);

  if (!$item) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteItem($item->id,$cat->category_id)) 	{
    set_feedback('success', 'Referensen togs bort');
  } else {
    set_feedback('error', 'Något blev galet, försök igen');
  }
  
   if(isset($cat)){
  foreach($cat as $d){
	  $c=$d->category_id;
	  var_dump($c);
	  $db->delCatItem($c,$id);	  
	  }
  }
  
  

  header("Location: /admin/index.php");
  ob_flush();