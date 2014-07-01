<?php

  require_once('../../config.php');
  //require_once(ROOT_PATH.'/classes/item.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $content='Alexis Capot - Edit: Here shows all the projetcs to edit them if you wanted.';
$pageTitle='Alexis Capot - Edit';

  $db = new Db();
  $items = $db->getItems();

  $page_title = "Referenser";

?>
<!doctype html>
<html>
    <head>
        <meta name="description" content="Curriculum Vitae - Alexis Capot - Tjänstgöringsintyg"/>
		<meta charset="UTF-8"> 
		<title>Alexis Capot - Portfolio</title>
        
        <!-- Make the page take the full width of the device-->
        <meta name="viewport"  content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1.0" />
         
        <!-- The stylesheet -->
     
        <link type="text/css" rel="stylesheet" href="../css/reset.css">
        <link type="text/css" rel="stylesheet" href="../css/style.css">
       
       
        
        <link type="text/css" rel="stylesheet" href="../css/responsive-gs-12col.css"/>
        
             
    </head>
<?php require_once(ROOT_PATH.'/header.php'); ?>

<section>
  <section class="span12">
    <h1>Referenser</h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Titel</th>
          <th>Kategori</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($items as $item) : ?>
          <tr>
            <td><a href="/show.php?id=<?php echo $item->id ?>"><?php echo $item->title ?></a></td>
            <td><?php $categories=$db->getCategoryByItemToShow($item->id); 
			    $numCat=count($categories);
				foreach ($categories as $cat)
								{
									
									$numCat--;
									echo $cat->name;
									//echo $numCat;
									if ($numCat==0){
									echo '';
									}
									else if ($numCat==1){
									echo ' och ';
									}
									
									else {echo ', ';}
									
								}
			?></td>
            <td>
              <a href="/admin/edit.php?id=<?php echo $item->id ?>">Redigera</a> |
              <a href="/admin/delete.php?id=<?php echo $item->id ?>">Ta bort</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <a class="btn" href="/admin/new.php">Ny referens</a>
  </section>
</section>

<?php require_once(ROOT_PATH.'/footer.php'); ?>