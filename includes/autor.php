 <?php
		include('../seguranca.php');
		
$autor = $_REQUEST['nome'];
$cadastra = DB::getConn()->prepare("INSERT INTO `authors` SET `nome`=?");		
$cadastra->execute(array($autor));

		


            $consulta = DB::getConn()->prepare("Select * from `authors` where `nome`=?");
		    $consulta->execute(array($autor));
			while ($consulta_autor = $consulta->fetch(PDO::FETCH_ASSOC))  { 
          
             $autor_post[] = array(
			'id'	=> $consulta_autor['id'],
			'nome' => $consulta_autor['nome'],
		);  
		  
			}
   echo(json_encode($autor_post));
	


?>