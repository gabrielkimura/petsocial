<?php
require_once "connection.php";
$db = Database::connection();

//Verifica se não tem uma sessão já iniciada, caso não tiver ele inicia a sessão
session_start();
// as variáveis 'login' e 'senha' recebem os dados digitados na página anterior
$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT *
	  FROM user
	 WHERE usuario = '$user' OR 
	 		email = '$user' 
	   AND senha = '$pass'";

$rs = $db->query($sql);

if($rs->rowCount() > 0){
	$_SESSION['usuario-logado'] = $user;
	$_SESSION['senha-logado'] = $user;
	header('location:../desaparecidos.php');
}
else{
	unset ($_SESSION['usuario-logado']);
	unset ($_SESSION['senha-logado']);
	header('location:../login.php?msg=Nome de usuário ou senha incorretos!&classe=danger'); // inserir pagina de login
}
?>