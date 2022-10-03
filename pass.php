<?php 
$hash = "$2y$12$5Sla0kX4NSQHwJKdWhhC1.bGRcK55pcZ2CI8nS3waNvdV/.V3oBTK";
if (!password_verify($_POST['password'], $hash)) { 
?>
<h2>Logueate</h2>
<form name="form" method="post" action="">
<input type="password" name="password"><br>
<input type="submit" value="Login"></form>
<?php 
}else{
?>
Contenido protegido
<?php 
} 
?>