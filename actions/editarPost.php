<?php
include('../seguranca.php');

// verifica se foi enviado um arquivo 
if(isset($_FILES['imagem']['name']) && $_FILES["imagem"]["error"] == 0)
{
	echo '<h3>';   
	


	$arquivo_tmp = $_FILES['imagem']['tmp_name'];
	$nome = $_FILES['imagem']['name'];
	

	// Pega a extensao
	$extensao = strrchr($nome, '.');

	// Converte a extensao para mimusculo
	$extensao = strtolower($extensao);

	// Somente imagens, .jpg;.jpeg;.gif;.png
	// Aqui eu enfilero as extesões permitidas e separo por ';'
	// Isso server apenas para eu poder pesquisar dentro desta String
	if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
	{
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = md5(microtime()) . '.' . $extensao;
		
		// Concatena a pasta com o nome
		$destino = '../uploads/' . $novoNome; 
		
		// tenta mover o arquivo para o destino
		if( @move_uploaded_file( $arquivo_tmp, $destino ))
		{
			//agora vamos salvar o poste no banco de dados 

            if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
							
				extract($_POST);
				
			
											
				if($titulo == '' OR strlen($titulo)<3){
					echo 'Escreva seu Titulo corretamente';
				}elseif($slug=='' OR strlen($slug)<6){
					echo 'Escreva seu Slug corretamente';
				}elseif($body==''){
					echo 'Escreva o corpo do seu texto corretamente!';
				}else{
					
				
					try{
													
					
							$published = 1;
							 $url = 'uploads/' . $novoNome;

			$apagar_foto = DB::getConn()->prepare("SELECT `image` FROM `posts` WHERE `id`=?");
			$apagar_foto->execute(array($id)); 
			while($apagar = $apagar_foto->fetch(PDO::FETCH_ASSOC)){
				if($apagar['image']!='0')
				//Apagar foto anterior do poste, não queremos encher o servidor de arquivos não necessarios! 
				unlink("../".$apagar['image']);
			}	 

            $inserir = DB::getConn()->prepare("UPDATE `posts` SET `title`=?, `slug`=?, `body`=?, `image`=?, `published`=?, `authors_id`=? WHERE `id`=?");
							
			if($inserir->execute(array($titulo,$slug,$body,$url,$published,$autor,$id))){
								
		//associar a postagem as suas tagas 
				$select = DB::getConn()->prepare("SELECT `id` FROM `posts` WHERE `title`=? AND `slug`=? AND `body`=? AND `authors_id`=?");
				$select->execute(array($titulo,$slug,$body,$autor));
				$delete = DB::getConn()->prepare("DELETE FROM `posts_tags` WHERE `posts_id`=?");
				$delete->execute(array($id));	
				while($poste = $select->fetch(PDO::FETCH_ASSOC)){
					foreach($tag as $t){
						$posts_tags = DB::getConn()->prepare("INSERT INTO `posts_tags` SET `posts_id`=?, `tags_id`=?");
						$posts_tags->execute(array($poste['id'],$t));
					}

				} header('Location: ../editar.php');			
			}                
					}catch(PDOException $e){
						
						logErros($e);
						echo $e->getMessage();
					}
				}
				echo '</h3>';
			}			

		}
		else
			echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
	if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
							
		extract($_POST);
		
	
									
		if($titulo == '' OR strlen($titulo)<3){
			echo 'Escreva seu Titulo corretamente';
		}elseif($slug=='' OR strlen($slug)<6){
			echo 'Escreva seu Slug corretamente';
		}elseif($body==''){
			echo 'Escreva o corpo do seu texto corretamente!';
		}else{
			
		
			try{
											
			
					$published = 1;
					// $url = 'uploads/' . $novoNome;
                    $img = 0;   
	$apagar_foto = DB::getConn()->prepare("SELECT `image` FROM `posts` WHERE `id`=?");
	$apagar_foto->execute(array($id)); 
	while($apagar = $apagar_foto->fetch(PDO::FETCH_ASSOC)){
		if($apagar['image']!='0')
		//Apagar foto anterior do poste, não queremos encher o servidor de arquivos não necessarios! 
		unlink("../".$apagar['image']);
	}	 

	$inserir = DB::getConn()->prepare("UPDATE `posts` SET `title`=?, `slug`=?, `body`=?, `image`=?, `published`=?, `authors_id`=? WHERE `id`=?");
					
	if($inserir->execute(array($titulo,$slug,$body,$img,$published,$autor,$id))){
						
//associar a postagem as suas tagas 
		$select = DB::getConn()->prepare("SELECT `id` FROM `posts` WHERE `title`=? AND `slug`=? AND `body`=? AND `authors_id`=?");
		$select->execute(array($titulo,$slug,$body,$autor));
		$delete = DB::getConn()->prepare("DELETE FROM `posts_tags` WHERE `posts_id`=?");
		$delete->execute(array($id));	
		while($poste = $select->fetch(PDO::FETCH_ASSOC)){
			foreach($tag as $t){
				$posts_tags = DB::getConn()->prepare("INSERT INTO `posts_tags` SET `posts_id`=?, `tags_id`=?");
				$posts_tags->execute(array($poste['id'],$t));
			}

		} header('Location: ../editar.php');			
	}                
			}catch(PDOException $e){
				
				logErros($e);
				echo $e->getMessage();
			}
		}
		echo '</h3>';
	}	
}
						
						?>