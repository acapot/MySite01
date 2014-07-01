<?php

  require_once('../../../config.php');
  require_once(ROOT_PATH.'/classes/db.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  if (isset($_POST['name'])) {
    $name = $_POST['name'];
  }

  $db = new Db();
  $category = $db->getCategory($id);

  if($db->updateCategory($id, $name)) {
    set_feedback('success', 'Kategorien uppdaterades');
  } else {
    set_feedback('error', 'Ojdå, det gick inte');
  }

  header("Location: /admin/categories/edit.php?id=".$category->id);

?>