<?php require_once('../config.php'); 
$content='Alexis Capot - Kontakt: Here you can send a message which will direct come in my personal e-mail.';
$pageTitle='Alexis Capot - Kontakt';
  require_once(ROOT_PATH.'/header.php');
							?>
    					
            <section id="content_wrap" class="row">
                
                             
                <div class="row">
                        <div id="cv" class="col span_12">
                        
                            <div class="row" id="form_contact">
                                <br/>
                                <h3 class="col span_12">Kontakta mig</h3><br />
                                <div class="col span_12">
                                    <p>Jag ska svara så snart som möjligt, tack!
                                    </p><br/>
                                
                                </div>
                                <div class="row">
                                    <div id="img_email" class="col span_6">
                                        
                                    </div>
                                    <div id="div_form" class="col span_6">
                                                        <?php
                                            ///////Configuraci&oacute;n/////
                                            //$mail_destinatario = 'root@localhost';
                                            ///////Fin configuraci&oacute;n//
                                            $menviado="";
                                            if (isset ($_POST['send'])) {
                                                    $to = "a_capot@hotmail.com";
                                                    //$to = "kundservice@tshirtdisco.com";
                                                    //$to = "root@localhost";
                                                    $subject = $_POST['asunto'];
                                                    $body.=$_POST['mensaje'];
                                                    $headers = "From:".$_POST['email'];
                                                    //$headers = "From: root@localhost";
                                                    
                                                        if (mail($to, $subject, $body, $headers)){
                                                        //$menviado="Mensaje enviado.";
                                                        $menviado="Tack f&ouml;r ditt medelande och vi ska svara s&aring; snart som m&ouml;jligt.";
                                                        }
                                                        else{ echo '<p>Finns något problem med ditt meddelande. Försök senare!</p>';
                                                        }
                                            }
                                           
                                            
                                            echo '<form action="kontakt.php" method="post">
                                            <label for="nombre">Namn </label> <br>
                                            <input type="text" name="nombre" size="52" maxlength="80"><br/>
                                            <label for="email">Din Email</label> <br>
                                            <input type="text" name="email" size="52" maxlength="60"><br/>
                                            <label for="asunto">&Auml;rende </label> <br>
                                            <input type="text" name="asunto" size="52" maxlength="60"><br/>
                                            <label for="mensaje">Medelande </label> <br>
                                            <textarea name="mensaje" cols="46" rows="5"></textarea> <br/>
                                            <label for="enviar">
                                            <button type="Submit" id="boton" name="send" value=""><b>Skicka</b></button>';
                                            
                                            if (isset ($menviado))
                                            echo "<p>{$menviado}</p>";
                                            
                                            echo '</form><br>';
                                            
                                            ?>
                                        </div>
                                   </div><!--row to form-->	

                                </div>
                        </div><!--cv-->	
                     </div>	
                <section>
  
            <?php include '../footer.php';?>