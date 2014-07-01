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
	//var_dump($_FILES['thumbnail']);
  if (!$item) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  $thumbnail_url = $item->thumbnail_url;

  if (isset($_FILES['thumbnail'])) {
    $thumbnail_url = set_thumbnail_image($item, $_FILES['thumbnail']);

    if (!$thumbnail_url) {
		//header("Location: /admin/edit.php?id=".$item->id);
      set_feedback('error', 'Du kan bara ladda upp bilder.');
      
    }
  }
  
  if(isset($cat)){
  foreach($cat as $d){
	  $c=$d->category_id;
	  var_dump($c);
	  $db->delCatItem($c,$id);	  
	  }
  }

  if ($db->updateItem($item->id, $_POST['title'], $_POST['text'], $thumbnail_url)) {
    set_feedback('success', 'Referensen uppdaterades');
  } else {
    set_feedback('error', 'Något blev galet, försök igen');
  }
  
  
  foreach($_POST['categoryAdd'] as $cat){
  $cat_items=$db->insertCatItem($cat,$item->id);
  }
  
  

 header("Location: /admin/edit.php?id=".$item->id);
  ob_flush();