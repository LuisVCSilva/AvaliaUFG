<?php
require('db.php');
?>
<<<<<<< HEAD
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
=======

<table BORDER="3" CELLPADDING="3" CELLSPACING="3">
	<tbody>
		<tr>
			<?php
			echo "<td>".$nome."</td>"
			?>
		</tr>
		<tr>
			<td>
			Disciplina:
				<?php
				$queryBuscaDisciplinas = "SELECT Disciplina.nome from Disciplina INNER JOIN Professor on Disciplina.FK_idProfessor = Professor.idProfessor AND Professor.nome='".$nome."'";
				
				 mysqli_query($db, $queryBuscaDisciplinas) or die('Error querying database.');
>>>>>>> 61a607952736b23a1af1be3b7bc4d13c4a5eaf61

				 $resultadoQueryBuscaDisciplinas = mysqli_query($db, $queryBuscaDisciplinas);
				 $resultadoBuscaDisciplinas = mysqli_fetch_array($resultadoQueryBuscaDisciplinas);

<<<<<<< HEAD
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
=======
				 echo "<select>";
				 while($resultadoBuscaDisciplinas = mysqli_fetch_array($queryBuscaDisciplinas))
				 {
	 			 echo "<option value='".$resultadoBuscaDisciplinas['nome']."'>".$resultadoBuscaDisciplinas['nome']."</option>";
				 }
				 echo "</select>";
				?>	
			</td>
		</tr>
		<tr>
			<td>
			 <textarea id = "campoComentario" rows="4" cols="50"></textarea>	
			</td>
		</tr>
		<tr>
			<td>
<form id="ratingsForm">
	Avaliação
	<div class="stars">
		<input type="radio" name="star" class="star-1" id="star-1" />
		<label class="star-1" for="star-1">1</label>
		<input type="radio" name="star" class="star-2" id="star-2" />
		<label class="star-2" for="star-2">2</label>
		<input type="radio" name="star" class="star-3" id="star-3" />
		<label class="star-3" for="star-3">3</label>
		<input type="radio" name="star" class="star-4" id="star-4" />
		<label class="star-4" for="star-4">4</label>
		<input type="radio" name="star" class="star-5" id="star-5" />
		<label class="star-5" for="star-5">5</label>
		<span></span>
	</div>  
</form>

			</div>
			
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="Avalia" value="Avaliar"></td>
		</tr>
		<tr>
			<td><input type="submit" name="resultados" value="Resultados"></td>
		</tr>
	</tbody>
</table>
>>>>>>> 61a607952736b23a1af1be3b7bc4d13c4a5eaf61
