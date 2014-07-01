<?php 
				require_once('../../config.php');
				
				require_once(ROOT_PATH.'/classes/item.php');
					//var_dump($items);			
			
		
			
			$msg='';
  if (isset($_POST) && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == USER && $password == PASS) {
      $_SESSION['is_logged_in'] = true;

      if (isset($_SESSION['return_to'])) {
        $return_to = $_SESSION['return_to'];
        $_SESSION['return_to'] = null;
        header('location: '.$return_to);
      } else {
        header('location: /admin');
		$msg="Du får logga in först";
      }
    }
  }

  $page_title = "Logga in";

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
			                                					
            <section id="content_wrap" class="row">
                
                             
                <div class="row">
                        <div id="cv" class="col span_12">
                        <h1>Logga in</h1>

                        	<form method="post" action="/admin/login.php">
    
    
                               <input type="text" class="ingreso" id="username" name="username" value="Username" onfocus="clearText(this);"/>
                               <input type="password" class="ingreso" id="password" name="password" value="Password" onfocus="clearText(this);"/>
                                <input type="submit"  id="boton_entrar" name="email" value="Loga in"/>
                			</form>
						       
                        </div><!--cv-->	
                     </div>	
                <section>
                 <script src="../js/javascript_alexis_capot_lib.js"></script>
  
            <?php require_once(ROOT_PATH.'/footer.php'); ?>