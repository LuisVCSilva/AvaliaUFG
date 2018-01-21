<?php
require('db.php');
?>

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

				 $resultadoQueryBuscaDisciplinas = mysqli_query($db, $queryBuscaDisciplinas);
				 $resultadoBuscaDisciplinas = mysqli_fetch_array($resultadoQueryBuscaDisciplinas);

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
