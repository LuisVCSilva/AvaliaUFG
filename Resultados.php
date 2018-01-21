<?php
require('db.php');
?>
<!--INICIO DOS RESULTADOS-->  
  <TABLE BORDER=1 CELLPADDING="0" CELLSPACING="0" width=100%>
   <tbody>

    <tr>
     <td colspan="2">
     <TABLE BORDER=1 CELLPADDING="0" CELLSPACING="0" width=100%>
		<?php

		if($tabela=="Professor")
		{
		$queryBuscaFeedback = "SELECT Feedback.texto,Feedback.pontuacao,Feedback.tempo,Feedback.FK_idProfessor,Feedback.idFeedback,Professor.nome as p_nome,Disciplina.nome as d_nome,Disciplina.idDisciplina from Feedback INNER JOIN Professor on Feedback.FK_idProfessor = Professor.idProfessor AND Professor.nome=\"".$nome."\" INNER JOIN Disciplina on Professor.FK_idDisciplina=Disciplina.idDisciplina ORDER BY Feedback.tempo DESC";
		}
		mysqli_query($db, $queryBuscaFeedback) or die('Erro 4');
		$resultadoQueryBuscaFeedback = mysqli_query($db, $queryBuscaFeedback);
		$k = 0;
		if(mysqli_num_rows($resultadoQueryBuscaFeedback) > 0)
		{
		$resultadoBuscaFeedback = mysqli_fetch_array($resultadoQueryBuscaFeedback);
			do
			{
			echo "<tr>\n";
				echo "<td style=\"word-wrap: break-word; width:100px;\">\n";
				echo "<a href=\"#bloco-".$resultadoBuscaFeedback['idFeedback']."\"></a>\n";
					echo "<div id=\"bloco-".$k."\" style=\"display:none\">";
					for($x=0;$x<$resultadoBuscaFeedback['pontuacao'];$x++)
					{
					echo "<img src=\"css/star-on-big.png\" width=30px alt=\"Estrela\">";
					}					
					echo "<br>&nbsp;	\"<i>".wordwrap($resultadoBuscaFeedback['texto'],50,"\n",true)."</i>\"&nbsp;\n";			
					echo "<br><br>\n<p align=\"left\"><sub>".$resultadoBuscaFeedback['d_nome']." - ".$resultadoBuscaFeedback['tempo']."</sub></p>\n";
					echo "</div>";
				echo "</td>\n";
			echo "</tr>\n";
			$k++;
			}
		while($resultadoBuscaFeedback = mysqli_fetch_array($resultadoQueryBuscaFeedback));
		}
		else
		{
		echo "<tr>";
		echo "<td>\n";		
		echo "<b><font color=\"red\">Nenhum comentário até o momento...</font></b>";
		echo "</td>";
		echo "</tr>";
		}
		?>
		</TABLE>
	    </td>
	  </tr>
	  <tr>
	  </tr>
	  <tr>
	    <td align="right"><button type="button" id="botaoCarregaComentario" class="btn btn-info" onclick="javascript:CarregaComentarios()" width="100%">Mais comentários</button></td>
	  </tr>
	</tbody>
</TABLE>
<!--FIM DOS RESULTADOS-->
