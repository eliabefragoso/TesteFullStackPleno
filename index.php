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
    <meta name="description" content="TesteFullStack" />
    <title>TesteFullStack</title>
    <link rel="stylesheet" href="estilos/app.css" />
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


<p>
               

<table class="tg">
  <tr id="novaTeg">
  <th class="tg-ow70"> <label for="id_pergunta">Tags:</label>  </th>    
  <?php 
     $tags = DB::getConn()->prepare('select * from tags;');
     $tags->execute();
    while($tag = $tags->fetch(PDO::FETCH_ASSOC)){
      
  ?>  
  <th class="tg-ow70"> <input type="checkbox" name="tag[]" class="get_value" value="<?php echo $tag['id']?>"/> <?php echo $tag['tag']?> </th>
    
 <?php } ?>
 
 
 <th class="tg-ow70"> <input type="checkbox" name="j[]" class="get_value" value="0" id="id_tag" checked=""/> Outra </th>
  </tr>

</table>
			 

            </p>
           
            <p><label for="id_nivel">Selecione o Autor:</label> 
		<select id="id_autor" name="autor"> 
        <?php 
               $autor = DB::getConn()->prepare('select * from authors;');
               $autor->execute();      
               while($a = $autor->fetch(PDO::FETCH_ASSOC)){
                   ?>
                  <option value="<?php echo $a['id']?>"> <?php echo $a['nome'] ?> </option>
              
              <?php   } ?>
                  <option value="0"> Outro </option>  
            		</select>
</p>	

                </div>
                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary">Cadastrar</button>
                </div>
            </fieldset>
                </form>
</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgtag">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formtag">
                <div class="modal-header">
                    <h5 class="modal-title">Informe a Nova Tag</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeTag" class="control-label">Tag:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tag" placeholder="Tag">
                        </div>
                    </div>

                   
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
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
$(function(){
    $('#id_tag').prop('checked', false);
    })
    

	
</script>


		<script type="text/javascript">

   
$(function(){
			$('#id_tag').change(function(){
			novoProduto();
             //   console.log("aqui");
			});
		});
	
        function montarLinha(p) {
        var linha = '<th class="tg-ow70" > <input type="checkbox" name="tag[]" class="get_value" value="'+p[0]["id"]+'" checked />'+p[0]["tag"]+'</th>';
        return linha;
    }

    

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
    
        function criarProduto() {
        t = { 
            tag: $("#tag").val(), 
        };
        $.post("includes/tags.php", t, function(data) {
            $('#dlgtag').hide();
            tag = JSON.parse(data);  
            linha = montarLinha(tag);
            $('#novaTeg').append(linha);
            $('id_tag').prop('', false);
            $('#id_tag').prop('checked', false);
        });
    }    


        function novoProduto() {
        $('#id').val('');
        $('#tag').val(''); 
        $('#dlgtag').show();
    }

    $("#formtag").submit( function(event){ 
        event.preventDefault(); 
       
            criarProduto();
            
            
    });

		</script>
		</body>
</html>
