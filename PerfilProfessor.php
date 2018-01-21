<?php
require('db.php');
?>
<!--INICIO DO PERFIL-->
<table BORDER="1" CELLPADDING="1" CELLSPACING="0" style="width:100%">
	<tbody>
	<?php
	$contexto = $tabela=="Disciplina" ? "Professor" : "Disciplina";
	?>
		<tr>
			<td width="100%">
			<?php
			//echo $contexto." ";
			$queryBuscaDisciplinas = "SELECT ".$contexto.".nome,Disciplina.idDisciplina,Professor.idProfessor,Professor.FK_idDisciplina from Disciplina INNER JOIN Professor on Disciplina.idDisciplina = Professor.FK_idDisciplina AND ".complementoContexto($contexto).".nome=\"".$nome."\" ORDER BY ".$contexto.".nome";
				 mysqli_query($db, $queryBuscaDisciplinas) or die('Erro 2');

				 $resultadoQueryBuscaDisciplinas = mysqli_query($db, $queryBuscaDisciplinas);
				 $resultadoBuscaDisciplinas = mysqli_fetch_array($resultadoQueryBuscaDisciplinas);

				 echo "<a target=\"_blank\" href=\"https://www.portaldatransparencia.gov.br/servidores/Servidor-DetalhaServidor.asp?IdServidor=".$idTransparencia."\">Pagina do docente no Portal da Transparência</a><br>";


				 echo "<a target=\"_blank\" href=\"https://sigaa.sistemas.ufg.br/sigaa/public/docente/portal.jsf?siape=".$siape."\">Pagina do docente no SIGAA</a><br>";

				 echo "\n\t\t\t\t<select name=\"lista\" style=\"width=100%\">\n";
				 echo "					<option value=\"-1\">Selecione ".($contexto=="Professor" ? "o professor" : "a disciplina")."</option>\n";
				 do
				 {
	 			 echo "					<option value=\"".$resultadoBuscaDisciplinas['id'.complementoContexto($contexto)]."\">".$resultadoBuscaDisciplinas['nome']."</option>\n";
				 }while($resultadoBuscaDisciplinas = mysqli_fetch_array($resultadoQueryBuscaDisciplinas));
				 echo "				</select>\n";
				 echo "<input type=\"hidden\" name=\"idProfessor\" value=\"".$_GET['idProfessor']."\">";
				?>
			</td>
		</tr>
		
		<tr>
			<td>
			<style>
			textarea {
   			width: 99%;
			}
			</style>
			 <textarea onkeyup="textCounter(this,'counter','300');" class="caixaComentario" id = "campoComentario" name="campoComentario" placeholder="Comentários..."></textarea>	
			<p align="right">&nbsp;<input type="text" placeholder="300 caracteres restantes" id="counter" style="border: 0px solid #505050;" readonly=true value=""></p>

			<script>
			function textCounter(field,field2,maxlimit)
			{
			var countfield = document.getElementById(field2);
			countfield.value = maxlimit - field.value.length + " caracteres restantes";
			}
</script>

			</td>
		</tr>

		<tr>
			<td>
            <span class="rating">Pontuação:
				<?php
				for ($x = 5; $x>=1; $x--) {
                echo "<input id=\"rating".$x."\" type=\"radio\" name=\"rating\" value=\"".$x."\">";
                echo "<label for=\"rating".$x."\">".$x."</label>";
				}
				?>
            </span>

			</td>
		</tr>

		<tr>
		<td>
		<!--captcha-->
		&nbsp;
		<center>&nbsp;<img src="captcha.php" width="100%" border="0" alt="CAPTCHA"><input type="text" size="6" maxlength="5" style="display:table-cell; width:100%" name="captcha" value=""></center>

		</td>
		</tr>

		<tr>
			<?php
			echo "<td align=\"right\"><br>";
			echo "<input type=\"submit\" class=\"btn btn-primary\" onclick=\"\" name=\"Avalia\" value=\"Avaliar\">";
			//echo "<input type=\"submit\" class=\"btn btn-primary\" onclick=\"\" name=\"Avalia-".$resultadoBuscaNomes['id'.$tabela]."\" value=\"Avaliar\">";
			echo "</td>";
			if(isset($_POST['Avalia']))
			//if(isset($_GET['Avalia-'.$resultadoBuscaNomes['id'.$tabela]]))
			{
			}			
			?>
		

		</tr>
		
		<tr>
			<td>
			</td>
		</tr>
	</tbody>
</table>
<!--FIM DO PERFIL-->
