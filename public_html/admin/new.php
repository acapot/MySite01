<?php

  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $categories = $db->getCategories();
  $page_title = "Ny referens";

require_once(ROOT_PATH.'/header.php'); ?>

<section class="row">
  <section class="formNew col span_12">
    <h1><?php echo $page_title ?></h1>
    <form method="post" action="create.php" enctype="multipart/form-data">
      <?php echo form_input('text', 'title', 'Lägga till en Item:') ?>
     
      <?php echo form_input('text', 'addCategory', 'Lägga till bara en ny kategory:') ?>
      <?php echo checkbox('category', $categories) ?>     
      <?php echo form_input('file', 'thumbnail', 'Liten bild: ') ?>
      <?php echo text_area('text', 'Beskrivning: ') ?>
      <?php echo submit_button('Spara') ?> <a href="/admin/index.php">Avbryt</a>
    </form>
  </section>
</section>

<?php require_once(ROOT_PATH.'/footer.php'); ?>