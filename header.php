<!doctype html>
<html>
    <head>
        <meta name="description" content="<?php echo $content; ?>"/>
        <meta name="keywords" content="C#,c sharp, HTML5,JavaScript, webbprogrammerare växjö, systemutvecklare Växjö, nätapplikationsprogrammerare växjö">
        <meta name="author" content="Alexis Capot">
		<meta charset="UTF-8"> 
		<title><?php echo $pageTitle; ?></title>
        
        <!-- Make the page take the full width of the device-->
        <meta name="viewport"  content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1.0" />
         
        <!-- The stylesheet -->
     
        <link type="text/css" rel="stylesheet" href="/css/reset.css">
        <link type="text/css" rel="stylesheet" href="/css/style.css">
        
        <?php
		//this is a special css style to a website certifikat.php 
 		if (strstr($_SERVER['REQUEST_URI'],"certifikat.php")){
        $specialStyleToCertificate= '<link type="text/css" rel="stylesheet" href="/js/slideshow/assets/css/slidestyles.css" />';
        $specialStyleToCertificate.='<link type="text/css" rel="stylesheet" href="/js/slideshow/assets/touchTouch/touchTouch.css"/>';
		
		}
		else $specialStyleToCertificate= null;
		
		echo $specialStyleToCertificate;
		?>
     
       
        
        <link type="text/css" rel="stylesheet" href="/css/responsive-gs-12col.css"/>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        
             
    </head> 
    <body>
        <div id="page_wrap" class="container row">			
            <header class="row">
                <hgroup>
                    
                </hgroup>
                <nav class="col span_12 clr">
                    
                    <ul class="ul_buttons">
            			<?php include 'menu.php';?>
                                   
                    </ul>
                    <?php
					
                    if (isset($_SESSION['is_logged_in'])) {
					 echo '<a href="/admin/logout.php">Logout</a>';
					}
                    ?>
                    
                    
                <!--<br style="clear:both;">-->
                <select id="mobile" class="show-phone" onChange="location = this.options[this.selectedIndex].value;">
                    <option value="index.php" selected>Hem</option>
                    <option value="certifikat.php">Certifikat</option>
                    <option value="portfolio.php">Portfolio</option>
                    <option value="kontakt.php">Kontakt</option>
                   
                </select>
                        

                </nav>
            </header>