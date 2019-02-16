<?php
include('../seguranca.php');

$nome = $_POST['nome'];
$disciplina = $_POST['disciplina'];
$descricao = $_POST['descricao'];



if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
							
							extract($_POST);
							
							echo '<h3>';
														
							if($nome == '' ){
								echo 'Escreva o nome do assunto';
								
							}else{
								
								
								
								try{
	//SELECT idAssunto FROM `assunto` WHERE Assunto='Logica' AND Disciplina_idDisciplina=13															
				$verificar = DB::getConn()->prepare("SELECT idAssunto FROM `assunto` WHERE Assunto=? AND Disciplina_idDisciplina=?");
								if($verificar->execute(array($nome,$disciplina))){
									if($verificar->rowCount()>=1){
										echo 'Esta Disciplina já esta cadastrado em nosso sistema';
									
									}else{
										
										
	$inserir = DB::getConn()->prepare("INSERT INTO `assunto` SET `Assunto`=?, `Descricao`=?, `Disciplina_idDisciplina`=?");
	//UPDATE `assunto` SET `Assunto` = 'Logica Simples', `Disciplina_idDisciplina` = '16' 
		
						if($inserir->execute(array($nome,$descricao,$disciplina))){
											echo 'Cadastrado com sucesso!';
											header('Location: ../cadastroAssunto.php');
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