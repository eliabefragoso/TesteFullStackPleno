<?php 
          include('seguranca.php');
              
          //echo "aqui";
         // echo  '<a href="?sair=true">sair</a>';
?>

<!doctype html>

<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GPM  - Um gerenciador pedagogico meritocratico" />
    <title>GPM -  Cadastro de Questões</title>
   
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
    <link rel="stylesheet" href="estilos/styles.css" />
    

</head>
<body>
<div class="content">
    <div class="header">
        <div class="pure-menu pure-menu-open pure-menu-fixed pure-menu-horizontal">
            <a class="pure-menu-heading" href="/">GPM</a>
            <ul>
                <li class="pure-menu-selected"><a href="/">Início</a></li>
                <li><a href="Turma.php">Turmas</a></li>
                

               
                
                
                <li><a href="#">Posts</a></li>
                
            
            
            <li><a href="?sair=true">sair</a></li>
            
            </ul>
        </div>
    </div>
    <div class="content">
            
           
            

<div class="pure-g-r content-ribbon">
        <div class="pure-u-1">
    
<form action="includes/salvarPoste.php" class="pure-form pure-form-aligned" method="post">
 
                    <input type='hidden' name='csrfmiddlewaretoken' value='I6liCbU6lImkvFwQ8FpcYLF5nHFa20S5' />
  <fieldset>
            <div class="pure-control-group">
                <div class="myfieldclass">
 <p><label for="id_titulo">Titulo:</label> <input id="id_titulo" name="titulo" type="text" /></p>   

  <p><label for="id_titulo">Slug:</label> <input id="id_slgu" name="slug" type="text" /></p>    

   <p><label for="id_titulo">Imagem:</label> <input id="id_titulo" name="titulo" type="file" /></p>          
                    
<p><label for="id_pergunta">Body:</label> <textarea cols="40" id="id_Body" name="body" rows="10">
</textarea></p>



                </div>
                </div>
                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary">Cadastrar</button>
                </div>
            </fieldset>
                </form>
</div>
</div>


    <div class="footer">
        TesteFullStackPleno
    </div>
</div>
		<script src="http://yui.yahooapis.com/3.12.0/build/yui/yui-min.js"></script>
		<script src="js/jquery-3.2.1.min.js"> </script>

        <script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script>
$( document ).ready( function() {
	$( 'textarea#id_Body' ).ckeditor();
} );


	
</script>


		<script type="text/javascript">

   
	$(function(){
			$('#id_Turma').change(function(){
				if( $(this).val() ) {
					$('#idDiciplina').hide();
					$('.carregando').show();
					$.getJSON('includes/disciplina.php?search=',{id: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolha Disciplina</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idDisciplina + '">' + j[i].Nome + '</option>';
						}	
						$('#idDiciplina').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#idDiciplina').html('<option value="">– Escolha a Disciplina –</option>');
				}
			});
		});

	


	$(function(){
			$('#idDiciplina').change(function(){
				if( $(this).val() ) {
					$('#id_assunto_idassunto').hide();
					$('.carregandoA').show();
					$.getJSON('includes/assunto.php?search=',{idAssunto: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolha O Assunto</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idAssunto + '">' + j[i].nome_assunto + '</option>';
						}	
						$('#id_assunto_idassunto').html(options).show();
						$('.carregandoA').hide();
					});
				} else {
					$('#id_assunto_idassunto').html('<option value="">– Escolha O Assunto  –</option>');
				}
			});
		});
	
	



		</script>
		</body>
</html>
