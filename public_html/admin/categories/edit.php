<?php

  require_once('../../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $category = $db->getCategory($id);

  $page_title = "Redigera kategori";

?>
<?php require_once(ROOT_PATH.'/header.php'); ?>

<div class="row-fluid marketing">
  <div class="span12">
    <h1><?php echo $page_title ?></h1>
    <form method="post" action="update.php">
      <input type="hidden" name="id" value="<?php echo $category->id ?>">
      <?php echo form_input('text', 'name', 'Titel:', $category->name) ?>
      <?php echo submit_button('Uppdatera'); ?>
      <a href="/admin/categories/index.php">Avbryt</a>
    </form>
  </div>
</div>