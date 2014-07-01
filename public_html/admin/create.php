<?php
ob_start();
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  //var_dump($_FILES['thumbnail']);
  var_dump($_POST['title']);
  if (!isset($_FILES['thumbnail'])) echo 'hola';
  
  if (isset($_POST['addCategory']) && $_POST['addCategory']!=''){
  	$item_id = $db->insertNewCat($_POST['addCategory']);
 	echo "if de addCategory";
  }
  
   
  else{
  		//$item = $db->getItemsById($id);
		if (isset($_FILES['thumbnail'])) {
				$thumbnail_url = set_thumbnail_image2($_FILES['thumbnail']);
				echo $thumbnail_url;
		
				if (!$thumbnail_url) {
					//header("Location: /admin/edit.php?id=".$item->id);
				  set_feedback('error', 'Du kan bara ladda upp bilder.');
				  
				}
			$item_id = $db->createItem($_POST['title'], $_POST['text'],$thumbnail_url);
			 }
			 
	  else $item_id = $db->createItem($_POST['title'], $_POST['text']);
	  
	  foreach ($_POST['category'] as $cat){
	  $cat_item= $db->insertCatItem($cat, $item_id);
	  }
	
	  if ($item_id) {
		set_feedback('success', 'Referensen skapades');
	  } else {
		set_feedback('error', 'Något blev galet, försök igen');
	  }

  }
  
  

  //header("Location: /admin/edit.php?id=".$item_id);
  header("Location: /admin/index.php");
    ob_flush();