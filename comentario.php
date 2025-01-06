<?php
  session_start();
  if((!isset ($_SESSION['usuario-logado']) == true) and (!isset ($_SESSION['senha-logado']) == true)){
    header("location:login.php");
  }else{
    require_once "configs/connection.php";
  }
?>
<?php
    require_once "./configs/connection.php";
    $db = Database::connection();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desaparecidos</title>
    <link rel="stylesheet" type="text/css" href="assets/css/menu-lateral.css">
    <link rel="stylesheet" type="text/css" href="assets/css/post.css">
    <link rel="stylesheet" type="text/css" href="assets/css/comments.css">
    <link rel="stylesheet" type="text/css" href="assets/css/comments-js.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("./assets/css/menu.php"); ?>
    <?php
        $sql = "SELECT c.userId AS userId, c.comentario as comentario, u.usuario as usuario FROM comentario c JOIN user u ON c.userId = u.userId WHERE postId = 2;";
        $consulta = $db->query($sql);
        $count = 0;
        while ($data = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $count++;
        ?>
        <div class="post-container">
            <div class="post-content">
                <div class="usuario">
                    <?=$data["usuario"];?></a></div>
                    <div class="descricao"><?=$data["comentario"];?></div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>  
</body>
</html>