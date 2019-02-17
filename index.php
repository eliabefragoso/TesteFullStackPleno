
<?php include('class/DB.class.php'); ?>
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
        <a class="pure-menu-heading" href="">TesteFullStackPleno</a>
        <ul>
            <li class="pure-menu-selected"><a href="#">Início</a></li>
            <li><a href="#">Cursos</a></li>
            <li><a href="#">Contato</a></li>
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
                    <p>
                        <a href="#" class="pure-button primary-button">Saiba mais</a>
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
                 $tags = DB::getConn()->prepare("Select t.tag from posts p inner join posts_tags pq on p.id = pq.posts_id inner join tags t on t.id=pq.tags_id where p.id=?;");
                 $tags->execute(array($p['id']));
                 while($tag = $tags->fetch(PDO::FETCH_ASSOC)){
                     echo ' <a class="pure-menu-heading" href="">'.$tag['tag'].'</a> / '; 
                 }
                 echo '</h6>';
                ?> 
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
    <div class="pure-g-r content-ribbon">
        <div class="pure-u-1-3">
            <div class="l-box">
                <img src="http://placehold.it/400x250"
                     alt="Fórum de Dúvidas">
            </div>
        </div>
        <div class="pure-u-2-3">
            <div class="l-box">
                <h4 class="content-subhead">Fórum de Dúvidas</h4>
                <h3>Interaja com seus Alunos</h3>
                <p>
                    No Simple MOOC você pode ter seu próprio sistema de fórum para que seus alunos possam interagir com você e com os outros alunos
                </p>
            </div>
        </div>
    </div>
    <div class="pure-g-r content-ribbon">
        <div class="pure-u-2-3">
            <div class="l-box">
                <h4 class="content-subhead">Exercícios</h4>
                <h3>Crie exercícios para avaliar seus alunos</h3>
                <p>
                    Você pode criar exercícios para que os alunos possam ser avaliados e todo o controle de notas e resolução dos exercícios é controlado pela plataforma, facilitando sua vida
                </p>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="l-box">
                <img src="http://placehold.it/400x250"
                     alt="Exercícios">
            </div>
        </div>
    </div>
    <div class="pure-g-r content-ribbon">
        <div class="pure-u-1-3">
            <div class="l-box">
                <img src="http://placehold.it/400x250"
                     alt="Mural de Avisos">
            </div>
        </div>
        <div class="pure-u-2-3">
            <div class="l-box">
                <h4 class="content-subhead">Mural de Avisos</h4>
                <h3>Envie anúncios diretamente para os alunos</h3>
                <p>
                    Organize os avisos do seu curso de forma fácil e simples.
                </p>
            </div>
        </div>
    </div>
    <div class="footer">
    TesteFullStackPleno - Uma simples plataforma de postagem de texto
    </div>
</div>
<script src="http://yui.yahooapis.com/3.12.0/build/yui/yui-min.js"></script>
</body>
</html>s