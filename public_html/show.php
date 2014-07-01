<?php require_once('../config.php'); 
$content='Alexis Capot - Show: Here you can see one of mine proyects.';
$pageTitle='Alexis Capot - Show';
				require_once(ROOT_PATH.'/header.php');
				$db = new Db();
				
  				
				$format = "";
				$urlWhitoutExt = "";
				if(isset($_GET['id'])) 
					{
					$id=$_GET['id'];
					$item = $db->getItemsById($id);
					$categories=$db->getCategoryByItemToShow($id);
					//var_dump($categories);
					}
					//var_dump($items);
				
					//echo count($items);

			?>                                					
            <section id="content_wrap" class="row">                            
                <div class="row">
                        <div id="cv" class="col span_12">
                        	<div class="row">
								<div class="col span_12">
                                	<h1><?php echo 'Projekt "'.$item->title.'" finns i categories '; 
									
									$numCat=count($categories);
									foreach ($categories as $cat)
													{
														
														$numCat--;
														echo $cat->name;
														//echo $numCat;
														if ($numCat==0){
														echo '.';
														}
														else if ($numCat==1){
														echo ' och ';
														}
														
														else {echo ', ';}
														
													}
									
									
									?></h2>
                                    
									
								</div>
                           </div>
                           <div class="row">
                             
								<div class="col span_6">
                                <?php 
									$format = substr($item->thumbnail_url, strlen($item->thumbnail_url)-3,3);
									 $urlWhitoutExt = substr($item->thumbnail_url, 0,strlen($item->thumbnail_url)-3);
									 //echo $format;
									 //echo strlen($item->thumbnail_url)-3;
									 $instruction = "Klicka på bilden för att gå till webbidan.";
									 if($format == "avi" || $format == "mp4"|| $format == "mov" || $format == "wmv" )
									 {
										 //echo "faefwfwfwef";
										 //$instruction = "<a href='".$urlWhitoutExt."zip'>Klicka här för att ladda ner koden.</a>";
										 $instruction = "";
										 echo '<video controls class="showGraterImg col span_12" href="/show.php?id='.$item->id.'" ><source src="'.$item->thumbnail_url.'" type="video/mp4"></video>';
										 //echo $instruction;
									 }
                                	else 
									{
									
									echo '<a class="showGraterImg col span_12" style="background-image:url('.$item->thumbnail_url.');" href="'.$item->url.'" ></a>';
									$instruction = "Klicka på bilden för att gå till webbidan.";
									}
                                	?>
										
								</div>
                                <div class="col span_6">
                                <?php 
                                	echo $item->text;
                                	?>
										<span id="showBoldText"><?php echo $instruction; ?></span>
                                        <p><a href="/portfolio.php">&laquo; Tillbaka</a></p>
								</div>
                            </div>					       
                        </div><!--cv-->	
                     </div>	
                <section>
  
            <?php include '../footer.php';?>
