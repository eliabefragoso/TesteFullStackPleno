<?php 

include('includes/header.php'); ?>        
        <div id="amarra-center-left">
        
            <div class="center">
               
                <div class="blocos" id="pagina">
                	<h2><?php echo ($idDaSessao<>$idExtrangeiro) ? 'Atualizações de '.$user_fullname : 'Minhas Atualizações'; ?></h2>
                    
                    <?php include('includes/form_recados.php'); ?>
                    
                    <?php 
					$solicitacoes = DB::getConn()->prepare('SELECT * FROM `amisade` WHERE para=? ANd `status`=0');
					$solicitacoes->execute(array($idDaSessao));
					
					$dadosamisade = DB::getConn()->prepare("SELECT `nome`,`sobrenome` FROM `usuario` WHERE `idUsuario`=? LIMIT 1");
					
					if($solicitacoes->rowcount()>0){
						$link = '<a href="php/amisade.php?ac=';
						echo '<ul>';
						while($resmeuamigo=$solicitacoes->fetch(PDO::FETCH_ASSOC)){
							
							$dadosamisade->execute(array($resmeuamigo['de']));
							$asdadsoamisade = $dadosamisade->fetch(PDO::FETCH_ASSOC);
							
							echo '<li>'.$asdadsoamisade['nome'].' '.$asdadsoamisade['sobrenome'].' quer ser seu amigo '.
							$link.'aceitar|'.$resmeuamigo['id'].'">aceitar</a> '.
							$link.'remover|'.$resmeuamigo['de'].'|'.$idDaSessao.'|'.$resmeuamigo['id'].'">recusar</a></li>';
						}
						echo '</ul>';
					}
				
					?>
                     
                </div><!--blocos-->

                <?php 
                
                new Notificacoes;
                $cache = Notificacoes::$cache;               

                // echo '<pre>';
                // print_r(Notificacoes::$arr);
                // exit;
                ?> 

                <div class="blocos" id="notificacoes">
                    <ul>
                    <?php
                    foreach (Notificacoes::$dados as $campos) {

                        extract($campos);
                        include('includes/notificacoes_' . $tipo . '.php');
                    }
                    ?>
                    </ul>
                    
                    <h3> Atenção avisos importantes! </h3> <br> 
                    
                    <h4> 
                       <?php 
                 //
 $aviso = DB::getConn()->prepare("SELECT recado FROM `recados` WHERE (de='1' OR de='19') AND para='publico'");
                  
     $aviso->execute(); 
     $i = 1; 
     while($av = $aviso->fetch(PDO::FETCH_ASSOC)){
                   echo '<p> <h3> Aviso Numero '.$i.' </h3> </p>';
                   echo '<p>';
                   echo $av['recado'];
                   echo '<br/> <br/> <br/>';
                   echo '</p>';
                   $i++; 
     }                
     
                ?>

                    
                    </h4>
                    
                </div>
                
                
                

            </div><!--center-->
            
            <div class="right">
            
                <?php include('includes/amigos.php'); ?>
                                
            </div><!--right-->

                    
        </div><!--amarra-center-left-->
        
<?php include('includes/footer.php'); ?>