
<?php include('seguranca.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TesteFullStackPleno" />
    <title>TesteFullStackPleno</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
    <link rel="stylesheet" href="estilos/styles.css" />
</head>
<body>
<div class="header">
    <div class="pure-menu pure-menu-open pure-menu-fixed pure-menu-horizontal">
        <a class="pure-menu-heading" href="editar.php">TesteFullStackPleno</a>
        <ul>
        <li> <form action="buscar.php" method="post" > 
            <input id="id_palavra" name="palavra" type="text" size="50"/> 
            
                    <button type="submit" class="pure-button pure-button-primary">Buscar</button>
            
            </form> </li>
            
            <li class="pure-menu-selected"><a href="editar.php">Início</a></li>
               
                

               
                
                
               <li><a href="editar.php">Posts</a></li>
               
               <li><a href="cadastroPoste.php">Postar Texto</a></li>
           
           <li><a href="?sair=true">sair</a></li>
            
            
          
           
        </ul>
    </div>
</div>
<div class="content">
    <div class="splash">
        <div class="pure-g-r">
            <div class="pure-u-1">
                <div class="l-box splash-text">
                    <h1 class="splash-head">
                        Uma Simples Plataforma de Postagem de Textos
                    </h1>
                    <h2 class="splash-subhead">
                        O TesteFullStackPleno visa simplificar a postagem de textos na internet, provendo ferramentas objetivas e de fácil uso par o compartilhamento de texto.
                    </h2>
                    <h3> Cadastre-se e venha fazer parte da comunicade  </h3>
                    <p>
                        <a href="cadastro.php" class="pure-button primary-button">Cadastra-se</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

 <?php 
            $poste = DB::getConn()->prepare("SELECT p.id, p.title, p.slug, p.body, p.image, a.nome FROM posts p INNER JOIN authors a ON p.authors_id=a.id;");
             $poste->execute();
             while($p = $poste->fetch(PDO::FETCH_ASSOC)){ 
                           
             
 ?>   
    <div class="pure-g-r content-ribbon">
        <div class="pure-u-2-3">
            <div class="l-box">
                <h4 class="content-subhead"><?php echo $p['title']?></h4>
                <h3><?php echo $p['slug']?></h3>
                <p>
                <?php echo $p['body']?>
                </p>
                <h5> Autor: <?php echo $p['nome']?> </h5>
                <h6>Tags: <?php 
                 $tags = DB::getConn()->prepare("Select t.id, t.tag from posts p inner join posts_tags pq on p.id = pq.posts_id inner join tags t on t.id=pq.tags_id where p.id=?;");
                 $tags->execute(array($p['id']));
                 while($tag = $tags->fetch(PDO::FETCH_ASSOC)){
                    echo ' <a class="pure-menu-heading" href="tag.php?id='.$tag['id'].'">'.$tag['tag'].'</a> / '; 
                 }
                 echo '</h6>';
                ?> 
                <h6> <a type="submit" class="button-warning pure-button" href="editaposte.php?id=<?php echo $p['id'] ?>">Editar</a> / <a type="submit" class="button-error pure-button" href="apagar.php?id=<?php echo $p['id'] ?>">Apagar</a>   </h6>
            </div>
        </div>
        <?php if($p['image'] != '0'){ ?>
        <div class="pure-u-1-3">
            <div class="l-box">
                <img src="<?php echo $p['image']?>"
                     alt="<?php echo $p['title']?>">
                   
            </div>
        </div>
        <?php }?>
    </div>
    <?php }?>
   
    <div class="footer">
    TesteFullStackPleno - Uma simples plataforma de postagem de texto
    </div>
</div>
<script src="http://yui.yahooapis.com/3.12.0/build/yui/yui-min.js"></script>
</body>
</html>