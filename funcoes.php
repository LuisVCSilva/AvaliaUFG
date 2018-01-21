<?php
function complementoContexto ($contexto) {
return $contexto=="Disciplina" ? "Professor" : "Disciplina";
}


function PostaComentario ($db,$comentario,$pontuacao,$FK_idProfessor) {
$comentario = substr($comentario,0,300);
$queryInsere = "INSERT INTO `Feedback` (`texto`, `pontuacao`, `FK_idProfessor`, `tempo`) VALUES ( '".$comentario."', '".$pontuacao."', '".$FK_idProfessor."', now())";
//echo $queryInsere;
$s = mysqli_query($db, $queryInsere) or die("Erro 666");
return mysqli_insert_id($db);
}
?>

