
<?php

  $menu = array();
  $menu[] = array('text' => '<span class="ca-icon">&#89;</span>Hem', 'url' => 'index.php');
  $menu[] = array('text' => '<span class="ca-icon">f</span>Certifikat', 'url' => 'certifikat.php');
  $menu[] = array('text' => '<span class="ca-icon">j</span>Portfolio', 'url' => 'portfolio.php');
  $menu[] = array('text' => '<span class="ca-icon">s</span>Kontakt', 'url' => 'kontakt.php');

 $current_url = "";
/* $current_url = $_SERVER['REQUEST_URI']; 
echo $current_url;

 echo $current_url=substr(strrchr( $current_url, "/"), 1);
 $current_url=substr(strrchr( $current_url, "/"), 1);
 
 echo $current_url;*/
 ?>


  <?php foreach ($menu as $menu_item) : ?>

    <?php
		$current_url = $_SERVER['REQUEST_URI'];
		//strrchr count the characters from the right and substr will eliminate the rest of the string from the '/'
		$current_url=substr(strrchr( $current_url, "/"), 1);
		$current_url=str_replace(substr(strrchr( $current_url, "?"), 0),"",$current_url);
		
      $cssClass = ' class="col span_2"';
	  //when we enter to the website the index will be activate with the class active
	  if ($current_url=='') {
        $current_url = 'index.php';
      }
		
      if ($menu_item['url'] == $current_url) {
        $cssClass = ' class="col span_2 active"';
      }
    ?>

    <li<?php echo $cssClass; ?>>
      <a href="/<?php echo $menu_item['url']; ?>">
        <?php echo $menu_item['text'];  ?>
      </a>
    </li>
  <?php endforeach ?>
