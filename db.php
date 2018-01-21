<?php
$db = mysqli_connect('localhost','root','','unichan')
or die('Erro 0');
mysqli_query($db,"SET NAMES 'utf8'");
mysqli_query($db,'SET character_set_connection=utf8');
mysqli_query($db,'SET character_set_client=utf8');
mysqli_query($db,'SET character_set_results=utf8');

?>
