<?php

  require_once('../../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $categories = $db->getCategories();
  $page_title = "Kategorier";
?>

<?php require_once(ROOT_PATH.'/header.php'); ?>

<div class="row-fluid marketing">
  <div class="span12">
    <h1><?php echo $page_title ?></h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Namn</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) : ?>
          <tr>
            <td><?php echo $category->name ?></td>
            <td><a href="edit.php?id=<?php echo $category->id ?>">Redigera</a> | Ta bort</td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
<?php require_once(ROOT_PATH.'/footer.php'); ?>