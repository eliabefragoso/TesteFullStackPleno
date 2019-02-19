<?php 
      session_start();
      ini_set("display_errors", 1);
	  error_reporting(E_ALL); 
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>TesteFullStackPleno - Cadastro</title>
        <link rel="stylesheet" href="estilos/cadastro.css" type="text/css" />
    </head>
    
    <body>
    
    	<div id="topo">
        	<div class="cAlign">
        		<span><a href="index.php"><img src="images/logo.png" alt="" border="0" /></a></span> <p><a href="index.php">Início</a><a href="#">Turmas</a><a href="#">Alunos</a></p>
          	</div><!---cAlign-->
        </div><!--topo-->
        
        <div class="cAlign">
        
            <div id="content">
                
                <div id="left">
                	
                    <ul>
                    	<li>email</li>
                        <li>senha</li>
                        
                    </ul>
                    
                </div><!--left-->
                
                <h1>Cadastre-se, <span>é gratis</span></h1>
                
            	<div id="formulario">
                	
                   <?php
						if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
							
							extract($_POST);
							
							echo '<h3>';
														
							if($nome == '' OR strlen($nome)<4){
								echo 'Escreva seu nome corretamente';
							}elseif($sobrenome=='' OR strlen($sobrenome)<6){
								echo 'Escreva seu sobrenome corretamente';
							}elseif($email==''){
								echo 'Escreva seu Email';
							}elseif(!preg_match("/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,4}$/i",$email)){
								echo 'Este e-mail é invalido';	
							}else{
								
								include('class/DB.class.php');
								
								try{
																
								$verificar = DB::getConn()->prepare("SELECT `id` FROM `users` WHERE `email`=?");
								if($verificar->execute(array($email))){
									if($verificar->rowCount()>=1){
										echo 'Este email ja esta cadastrado em nosso sistema';
										
									}elseif($senha=='' OR strlen($senha)<4){
										echo 'Digite sua senha, ela tem de ter mais de 4 caracteres';
									
									}else{
										$senhaInsert = sha1($senha);
										
										$nomecompleto = $nome.' '.$sobrenome;
										$inserir = DB::getConn()->prepare("INSERT INTO `users` SET `email`=?, `password`=?, `nome`=?");
										
						if($inserir->execute(array($email,$senhaInsert,$nomecompleto))){
											header('Location: ./editar.php');
										}
									}
								}
								}catch(PDOException $e){
									
									logErros($e);
									echo $e->getMessage();
								}
							}
							echo '</h3>';
						}						
					?>

                    <form name="cadastro" action="" method="post">
                    	<div>
                        	<div class="inputFloat">
                            	<span>nome</span>
                            	<input type="text" class="txtImput" name="nome" value="<?php if(isset($nome)) echo $nome; ?>" />
                            </div><!--inputFloat-->
                            
                            <div class="inputFloat">
                            	<span>sobrenome</span>
                            	<input type="text" class="txtImput" name="sobrenome" value="<?php if(isset($sobrenome)) echo $sobrenome; ?>" />
                            </div><!--inputFloat-->
                      	</div>
                        
                      
                       
                        
                        <span class="spanHide">informe seu Email:</span>
                        <input class="txtImput" type="text" name="email" value="<?php if(isset($email)) echo $email; ?>" />
                        
                        <span class="spanHide">senha</span>
                        <input type="password" class="txtImput" name="senha" value="<?php if(isset($senha))echo $senha; ?>" />
                        
						
							<span>&nbsp;</span>
                        <input class="submitCadastro" border="0" type="submit" value="" />
                        </div><!--inputFloat-->
                    
                    
                    </form>
                </div><!--formulario-->
            </div><!--content-->
    	</div><!--cAlign-->
        
        <div id="footer">
        	<p>&copy;TesteFullStackPleno - Todos os direitos reservados</p>
        </div><!--footer-->
        
    </body>
</html>