<?php
require('db.php');
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="tema.css">
<title>
Unichan - UFG
</title>
</head>

<body>


<div style="width: 500px; margin: 100px auto 0 auto;">
<form>
 <br>
 Pesquisa:
 <input type="text" name="campo-pesquisa" value="">

 <input type="submit" name="buscaBotao" value="Busca">
 <br>
 <br> 
 <input type="radio" name="tipoPesquisa" value="Professor"> Professor<br>
 <input type="radio" name="tipoPesquisa" value="Disciplina"> Disciplina<br>
</form> 
</div>
<br>


<script type="text/javascript">
     function switchElemento (id) {
       	var e = document.getElementById(id);
       	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
     }
</script>

<?php

if(isset($_GET['buscaBotao']))
{
$queryBuscaNomes = "SELECT * FROM `".$_GET['tipoPesquisa']."` WHERE nome LIKE \"%".$_GET['campo-pesquisa']."%\" limit 20";

mysqli_query($db, $queryBuscaNomes) or die('Error querying database.');

$resultadoQueryBuscaNomes = mysqli_query($db, $queryBuscaNomes);
$resultadoBuscaNomes = mysqli_fetch_array($resultadoQueryBuscaNomes);



echo "<form method=\"post\">\n";
echo "<table border=2  CELLPADDING=\"10\" CELLSPACING=\"10\">\n";
while ($resultadoBuscaNomes = mysqli_fetch_array($resultadoQueryBuscaNomes)) {
 echo "<tr>";
 	echo "\n";
 	echo " <td>";
	$nome = $resultadoBuscaNomes['nome'];
	echo "<a href=\"javascript:switchElemento('detalhes-".$resultadoBuscaNomes['idProfessor']."');\">".$resultadoBuscaNomes['nome']."</a>";
	
	echo "</td>\n";

 	echo "<td>\n";
	echo "<div id='detalhes-".$resultadoBuscaNomes['idProfessor']."' style=\"display:none;\">";
        include "PerfilProfessor.php";
	echo "</div>";
	echo "  </td>\n";
 echo "</tr>";
echo "\n";
}
echo "\n";
echo "</table>\n";
echo "</form>\n";
mysqli_close($db);
}
echo "\n"
?>
</body>
</html>
