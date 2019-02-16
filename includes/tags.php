 <?php
		include('../seguranca.php');
		
$tag = $_REQUEST['tag'];
$cadastra = DB::getConn()->prepare("INSERT INTO `tags` SET `tag`=?");		
$cadastra->execute(array($tag));

		


            $consulta = DB::getConn()->prepare("Select * from `tags` where `tag`=?");
		    $consulta->execute(array($tag));
			while ($consulta_tag = $consulta->fetch(PDO::FETCH_ASSOC))  { 
          
             $tag_post[] = array(
			'id'	=> $consulta_tag['id'],
			'tag' => $consulta_tag['tag'],
		);  
		  
			}
   echo(json_encode($tag_post));
	


?>