<?php require_once('../config.php'); 

$content='Alexis Capot - Portfolio: Here you can see some of the proyects I\'ve made.';
$pageTitle='Alexis Capot - Portfolio';			
				require_once(ROOT_PATH.'/header.php');
				$db = new Db();
  				$categories = $db->getCategories();				
			?>
                                					
            <section id="content_wrap" class="row">
                
                             
                <div class="row">
                        <div id="cv" class="col span_12">
                        	<div class="row">
								<div class="col span_2">
                                	<h2>Kategorier</h2><hr/>
									<ul class="ulWhitoutStyle">
                                     
                                    	<?php foreach ($categories as $field): ?>
                                         
           								 <li class="li_portfolio"><?php echo portfolio_categories($field) ?></li>
        								<? endforeach; ?>
                                  
                                    </ul>
								</div>
								<div class="col span_10">
                                	<h2><?php 
									$catergoryName='Kategori: ';
									if(isset($_GET['name'])) {
										//when is C# this return only C so I must to add this condition
										if($_GET['name']=="C") $catergoryName.="C#";
										
										else $catergoryName.=$_GET['name'];
									}
									 
									else $catergoryName='Mina projekt';
									
									
									echo $catergoryName?></h2><hr/>
										<div class="row">								
										<?php
												if(isset($_GET['id'])  && $_GET['id']!=0) 
												{
												$id=$_GET['id'];
												$items = $db->getItemsByCategory($id);
												}
												
												else $items = $db->getItems();
												$numItems=count($items);
												$i=0;
												foreach ($items as $item)
													{
														//the extra code is for to insert the row div each 3 round
														$i+=1;
														$rest=$numItems-$i;
														//for exemple to start with the row div I need to set them when $i is iqual 4, 7, 10 and to know if $i is in those number I must to rest one and take the residual value between ($i-1)%3 and it must be zero
														$rem=($i-1)%3;
														if ($rem==0 || $i==1) echo "<div class=row>";
														echo '<section class="div_portfolio col span_4">'.portfolio_show_items($item).'</section>';
														//to end with the row div I need to set them when $i is iqual 3, 6, 9, so on and to know if $i is in those number I must to take the residual value between $i%3 and it must be zero
														$rem=$i%3;
														$lastEndDiv=$numItems%3;
														//if ($rem==0 || $rest==$lastEndDiv) echo "</div>mm";
														if ($rem==0 || $numItems==$i) echo "</div>";
													}
                                             	
                                          ?>
                                    	</div>
                                  </div>
							</div>
                        </div><!--cv-->	
                     </div>	
                <section>
  
            <?php include '../footer.php';?>