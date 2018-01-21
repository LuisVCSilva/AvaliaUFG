<?php
require('db.php');
require('funcoes.php');
?>
<!DOCTYPE html>
<head>
<title>
Avalia UFG - Beta
</title>

<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>


      <link rel="stylesheet" href="css/style.css">


</head>

<body>

  <div class="container" ng-app="myApp" ng-controller="Example">
	<div class="jumbotron" id="banner">
		<style type="text/css">
		.banner {
		background-image: url('waifu.png');
		background-repeat: no-repeat;
		background-size: contain;
     		background-position: right; 
		}
		</style>
		<div class="banner">

			<h2><strong>Avalia UFG - Beta</strong></h2>
			<br>
			<medium>Um sistema em desenvolvimento para avaliação contínua e transparente do corpo docente da Universidade Federal de Goiás.</medium>
			<br>
			<br>
			<b>Informes:</b>
			 <ol type="I">
			  <li>Este não é um site oficial da UFG;</li>
			  <li>As avaliações são anônimas;</li>
			  <li>Não somos responsáveis pelo conteúdo postado;</li>
			  <li>Qualquer conteúdo pode ser removido a qualquer momento;</li>
			  <li>Isto é um experimento sujeito a mudanças...</li>
			</ol> 

			<small><i>"Don't be evil..."</i></small>
		</div>
	</div>

 <HR COLOR="green" WIDTH="40%">

<div style="width: 100%; margin: 0px auto 0 auto;">
<center>
 <form>
	<table border="0" CELLPADDING="3" CELLSPACING="3">
		<tr>
		<td><!--[<a href="index.php">Home</a>]--></td>
		</tr>

		<tr>
		<td></td>
		</tr>
 		<tr>
			<td width=90%>
			<input class="form-control" id="inputdefault" type="text" width="100%" name="campo-pesquisa" placeholder="Busca.." value="">
			</td>
		
			<td>
			 &nbsp;
			 <button type="submit" name="buscaBotao" class="btn btn-primary">
    		 <span class="glyphicon glyphicon-search"></span>
  	 		 </button>
			</td>
		</tr>
		<tr>    	
			<td colspan="3">
     		<!--<input type="radio" name="tipoPesquisa" value="Professor"> Professor<br>-->
     		<!-- <input type="radio" name="tipoPesquisa" value="Disciplina"> Disciplina<br>-->
    		</td>
		</tr>
	</table>
</form> 
</center>
</div>
</div>


<script type="text/javascript">



	function checkForm(form)
	{
	if(form.rating.value>5 || form.rating.value<1) {
      alert('Entre com uma pontuação (ao menos uma estrela)!');
      return false;
	}

    if(!form.captcha.value.match(/^\d{5}$/)) {
      alert('Entre com o captcha!');
      form.captcha.focus();
      return false;
    }
	if(form.lista.value==-1)
	{
      alert('Selecione uma disciplina!');
      form.lista.focus();
      return false;	 
	}
	if(form.campoComentario.value==="" || form.campoComentario.value.length>300)
	{
      alert('Escreva um comentário válido!');
      form.campoComentario.focus();
      return false;	 
	}

    return true;
  	}


	function scrollTo(hash) {
    location.hash = "#" + hash;
	}

     function switchElemento (id) {
       	var e = document.getElementById(id);
       	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
     }

    
	var x = 0;
	function CarregaComentarios () {
       	var e = document.getElementById("bloco-"+x.toString());
		if(e==null)
		{
		alert("Todos os comentários foram carregados");
		document.getElementById("botaoCarregaComentario").disabled = true; 
		}
		else
		{
       	e.style.display = 'block';
		scrollTo("bloco-"+x.toString());
		x++;
		}
     }

</script>
 <HR COLOR="green" WIDTH="50%">
<?php
$query = "";
$tabela = "Professor";
//echo "<center><b><font color=\"red\">Campo de pesquisa em branco</font></b></center>";
//echo "<center><b><font color=\"red\">Registro não encontrado</font></b></center>";
//echo "<center><b><font color=\"red\">Tipo de pesquisa não selecionado</font></b></center>";
echo "<div class=\"content\">\n";
if(isset($_POST['Avalia']))
{
$comentario = $_POST['campoComentario'];
$pontuacao = $_POST['rating'];
$FK_idProfessor = $_POST['lista'];
$idProfessor = $_POST['idProfessor'];
session_start();
if($_POST['captcha'] != $_SESSION['digit'])
{
echo "<div class=\"alert alert-danger\" role=\"alert\">\n";
echo "Captcha Incorreto.\n<br>Seu post não foi realizado.\n";
echo "</div>\n";
die();
header("Location: index.php?idProfessor=".$idProfessor);
}
session_destroy();
$idComentario = PostaComentario($db,$comentario,$pontuacao,$FK_idProfessor);
echo "<div class=\"alert alert-success\" role=\"alert\">\n";
echo "Feedback submetido com sucesso\n";
echo "</div>\n";
header("Location: index.php?buscaBotao=&idProfessor=".$idProfessor);
}
if(isset($_GET['buscaBotao']))
{
$flag = false;
$contResults = 0;
if((/*isset($_GET['tipoPesquisa'])*/true && isset($_GET['campo-pesquisa'])) || (isset($_GET['idProfessor']) || isset($_GET['idDisciplina'])))
{
	if((isset($_GET['idProfessor']) || isset($_GET['idDisciplina'])))
	{
	//$tabela = isset($_GET['idProfessor']) ? "Professor" : "Disciplina";
	$alvo = $_GET['id'.$tabela];	
	$query = "SELECT * FROM `".$tabela."` WHERE id".$tabela."=".$alvo;
	}
	else if(trim($_GET['campo-pesquisa']))
	{
	//$tabela = $_GET['tipoPesquisa'];
	$alvo = $_GET['campo-pesquisa'];
	$query = "SELECT * FROM `".$tabela."` WHERE nome LIKE '%".$alvo."%' GROUP BY(nome) ORDER BY(nome)";
	}
	if(trim($query))
	{
	$resultadoQuery = mysqli_query($db, $query);
	$contResults = mysqli_num_rows($resultadoQuery);
	$flag = true && $contResults > 0;
	}
}
/*echo "<div class=\"alert alert-success\" role=\"alert\">";
echo  mysqli_num_rows($resultadoQueryBuscaNomes)>1 ? ("A busca retornou ".mysqli_num_rows($resultadoQueryBuscaNomes)." ".($tabela=="Professor" ? "professores" : "disciplinas")) : ("A busca retornou ".mysqli_num_rows($resultadoQueryBuscaNomes)." ".$tabela);
echo "</div>";*/



if($flag==true)
{
echo "<form method=\"POST\" onsubmit=\"return checkForm(this);\">\n";

if(isset($_GET['tipoPesquisa']) || true)
{
	if(isset($_GET['campo-pesquisa']))
	{
	echo "<div class=\"alert alert-success\" role=\"alert\">\n";
	echo "Mostrando os primeiros 20 resultados de uma consulta que retornou ".$contResults.($contResults==1 ? " resultado" : " resultados") . "\n";
	echo "</div>\n";
	}
}
echo "<table BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\">\n";
echo "<tr>\n";

	echo "<td>\n";
	echo "<table BORDER=\"1\" CELLPADDING=\"0\" CELLSPACING=\"0\" width=100%>\n";
	$resultadoBuscaNomes = mysqli_fetch_array($resultadoQuery);
	$k = 0;
	do {
	 echo "<tr>\n";
	 	echo "\n";
	 	echo " <td>\n";
		$nome = $resultadoBuscaNomes['nome'];
		echo "<button type=\"button\" class=\"btn btn-dark\" style=\"width:100%;\" onclick=\"location.href='/unichan/index.php?buscaBotao=&amp;id".$tabela."=".$resultadoBuscaNomes['id'.$tabela]."';\"><span class=\"pull-left\">".$resultadoBuscaNomes['nome']."</span></button>\n";	
		echo "</td>\n";

		if($contResults==1 && isset($_GET['idProfessor']))
		{
		echo "<tr>\n";
		 	echo " <td width=100%>\n";
			echo "<div id='Perfil-".$resultadoBuscaNomes['id'.$tabela]."' width=100%>\n";
			$siape = $resultadoBuscaNomes['siape'];
			$idTransparencia = $resultadoBuscaNomes['idTransparencia'];
			include "PerfilProfessor.php";
			echo "</div>\n";
			echo "  </td>\n";
		echo "</tr>\n";

		echo "<tr>";
		 	echo " <td>";
			echo "<div id='Resultado-".$resultadoBuscaNomes['id'.$tabela]."'>";
				include "Resultados.php";
				echo "\n</div>\n";
			echo "</td>\n";
	 	echo "</tr>\n";
		}
		else
		{
		echo "</tr>\n";
		echo "\n";
		}
	$k++;
	if($k>=20)
	{
	break;
	}

	}while($resultadoBuscaNomes = mysqli_fetch_array($resultadoQuery));
	echo "\n";

	echo "</table>\n";
	echo "</td>\n";

	echo "<td>outra coisa\n";
	echo "</td>\n";


	echo "<td>anuncio\n";
	include "Anuncia.php";
	echo "</td>\n";

echo "</tr>\n";
echo "</table>\n";
echo "</form>\n";
}
else
{
echo "<div class=\"alert alert-danger\" role=\"alert\">\n";
echo "A consulta não retornou nenhum resultado...<br>Certifique-se de "./* selecionar uma opção de busca assim como*/"entrar com um nome no campo de busca.\n";
echo "</div>\n";
}
}
else
{
}
echo "</div>\n";

mysqli_close($db);
echo "\n"
?>
<HR COLOR="green" WIDTH="60%">
<br>
<center>
Copyright &copy; 2017 - Swartz Jr. - Alguns direitos reservados.
</center>
<br>
</body>
</html>
