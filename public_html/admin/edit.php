<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $content='Alexis Capot - Edit: Here I can edit the information about mine projects.';
$pageTitle='Alexis Capot - Edit';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $item = $db->getItemsById($id);

  if (!$item) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  $page_title = "Redigera referens";
  
  $categories = $db->getCategories();
  $catByItem= $db->getCategoryByItemToShow($id);
  

 require_once(ROOT_PATH.'/header.php'); ?>

<section id="content_wrap" class="row">
               
                        <div id="cv" class="col span_12">
                            
                              <section class="col span_12">
                                <h1><?php echo $page_title ?></h1>
                                <form method="post" action="update.php" enctype="multipart/form-data">
                                  <input type="hidden" name="id" value="<?php echo $item->id ?>">
                                  <?php echo form_input('text', 'title', 'Titel:', $item->title);
                                  
                                   echo checkboxEdit('categoryAdd', $categories,$catByItem,'Redigera Kategory' );
                                   
                                   ?><?php if ($item->thumbnail_url) : ?>
                                    <div>
                                      <img id="formImg" src="/<?php echo $item->thumbnail_url ?>">
                                    </div>
                                  <?php endif ?><?php echo form_input('file', 'thumbnail', 'Liten bild: ');
                                   echo text_area('text', 'Beskrivning: ', $item->text);
                                   echo submit_button('Uppdatera');?><a href="/admin/index.php">Avbryt</a>
                                </form>
                              </section>
                           
                           </div>
                        
                       </section>
<?php require_once(ROOT_PATH.'/footer.php'); ?>