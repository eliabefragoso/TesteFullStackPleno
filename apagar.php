<?php 

include('seguranca.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete_tags = DB::getConn()->prepare("DELETE FROM posts_tags WHERE posts_id=?");
    $delete_tags->execute(array($id));
    $select_foto = DB::getConn()->prepare("SELECT `image` FROM `posts` WHERE `id`=?");
    $select_foto->execute(array($id));
    while($apagar = $select_foto->fetch(PDO::FETCH_ASSOC)){
        if($apagar['image']!='0')
        //Apagar foto do poste, não queremos encher o servidor de arquivos não necessarios! 
        unlink($apagar['image']);
    }
   $delete_post = DB::getConn()->prepare("DELETE FROM `posts` WHERE `id`=?"); 
   $delete_post->execute(array($id));
   header('Location: ../TesteFullStackPleno/editar.php');
   
}




?>