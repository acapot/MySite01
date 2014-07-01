<?php

  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $item = $db->getItemsById($id);

  if (!$item) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  $page_title = $item->title;

?>
<?php require_once(ROOT_PATH.'/header.php'); ?>

<div class="row-fluid marketing">
  <div class="span12">
    <h1>Ta bort <?php echo $item->title ?>?</h1>
    <form action="/admin/destroy.php" method="post">
      <input type="hidden" name="id" value="<?php echo $item->id ?>">
      <p>Är du säker på att du vill ta bort <?php echo $item->title ?>?</p>
      <button type="submit" class="btn btn-danger">Ta bort</button> <a href="/admin">avbryt</a>
    </form>
  </div>
</div>

<?php require_once(ROOT_PATH.'/footer.php'); ?>