<?php 

include('../seguranca.php'); 

$pergunta = $_POST['pergunta'];
$resposta = $_POST['resposta'];
$score = $_POST['score'];
$nivel = $_POST['nivel']; 
$assunto_idassunto = $_POST['assunto_idassunto']; 

 
						if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
							
							extract($_POST);
							
							echo '<h3>';
														
							if($pergunta == '' OR strlen($pergunta)<4){
								echo 'Escreva a pergunta corretamente';
							}elseif($resposta==''){
								echo 'Não se esqueça da resposta';
							}elseif($score==''){
								echo 'Não esqueça de informar o valor da questão';
							}elseif($nivel==''){
								echo 'Não esqueça de informar o peso da questao.';	
							}else{
								
								include('classes/DB.class.php');
								
								try{
																
								if($assunto_idassunto=='' ){
										echo 'Selecione o Assunto da Questao';
									
									}else{
										
										
$inserir = DB::getConn()->prepare("INSERT INTO `questao` SET `pergunta`=?, `Resposta`=?, `Score`=?, `Nivel`=?, `Assunto_idAssunto`=?");
			
						if($inserir->execute(array($pergunta,$resposta,$score,$nivel,$assunto_idassunto))){
											echo 'Cadastrado com sucesso!';
											header('Location: ../cadastroQuestao.php');
										
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
