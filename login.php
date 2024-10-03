<?php
session_start();
if(isset($_SESSION['usuario-logado'])){
  header('location:desaparecidos.php');
}
?>

<!DOCTYPE html>
<!-- doctype informa ao agente de usuário a versão do html que deve ser renderizada-->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSocial Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="test">
  <div class="container">
    <div class="left">
      <img src="assets/img/logo-colorido.png" alt="Pet Image" class="pet-image">
    </div>
    <div class="right">
      <h1>PetSocial</h1>
      <form action="configs/valida_sessao.php" method="post">
        <p>Insira o login</p>
        <input type="text" id ="user" name="user" placeholder="Usuário/E-mail" required>
        <input type="password" id="pass" name="pass" placeholder="Senha" required>
        <div class="buttons">
          <button type="submit" class="btn-login">Entrar</button>
          <button type="button" class="btn-register">Criar Conta</button>
        </div>
      </form>
      <p class="terms">
        Ao se inscrever, você concorda com os Termos de Serviço e a Política de Privacidade, Incluindo o Uso de Cookies.</p>
    </div>
  </div>
  <?php
  if(isset($_GET['msg'])){
    echo '<div class="d-flex justify-content-center mt-5">
    <div class="alert alert-'.$_GET['classe'].'">'.$_GET['msg'].'</div>
    </div>';
  }
  ?>
  </div>
</body>
</html>