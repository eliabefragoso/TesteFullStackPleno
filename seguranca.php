<?php 
	ini_set('display_errors', 'On');
	
	include('class/DB.class.php');
	include('class/Login.class.php');
	
	$objLogin = new Login;

if(!$objLogin->logado()){
	include('login.php');
	exit();
}

if(isset($_GET['sair'])){
	$objLogin->sair();
	header('Location: ./');
    exit;
}

$idExtrangeiro = (isset($_GET['uid'])) ? (int)$_GET['uid'] : $_SESSION['fullstack_uid'];
$idDaSessao = $_SESSION['fullstack_uid'];

$idExists = DB::getConn()->prepare('SELECT `id` FROM `users` WHERE `id`=?');
$idExists->execute(array($idExtrangeiro));
if($idExists->rowCount()==0){
	$objLogin->sair();
    header('Location: ./');
    exit;
}

$dados = $objLogin->getDados($idExtrangeiro);

if(is_null($dados)){
	header('Location: ./');
	exit();
}else{
	extract($dados,EXTR_PREFIX_ALL,'user'); 
}

function user_img($img){
	return ($img<>'' AND file_exists('uploads/usuarios/'.$img)) ? $img : 'default.png';
}

function dd($in, $dump = false)
{
    echo '<pre>';

    if ($dump) {
        var_dump($in);
    } else {
        print_r($in);
    }

    echo '</pre>';

    exit;
}


//$user_fullname = $user_nome.' '.$user_sobrenome;


 ?>        

