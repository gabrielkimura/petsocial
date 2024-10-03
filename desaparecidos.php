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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("./assets/css/menu.php");?>
    <?php
       
        $sql = "SELECT p.userId AS id, p.descricao AS descricao, u.usuario AS usuario, p.image1 AS image1, p.image2 AS image2, u.tipoUser AS tipo 
            FROM post p JOIN user u ON p.userId = u.userId WHERE u.tipoUser = 'Fisico';";
        $consulta = $db->query($sql);
        $count = 0;
        while ($data = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $count++;
        ?>
        <div class="post-container">
            <div class="post-content">
                <div class="usuario"><?=$data["usuario"];?></div>
                <div class="descricao"><?=$data["descricao"];?></div>
                <div class="post-images"><img src="<?=$data["image1"];?>">
                <?php 
                if (is_null($data["image2"])){ ?>
                  </div>
                <?php
                }else{ ?>
                    <img src="<?=$data["image2"];?>"></div>
                <?php 
                }?>
                <div class="comments">
                    <a href="#" class="comentario">
                        <img src="assets/img/comment.png" alt="Mais"></a>
                        <!-- Modal de Comentário -->
                        <div id="commentModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Comentário</h2>
                                <form id="commentForm">
                                    <textarea id="commentText" rows="4" cols="50" required></textarea>
                                    <button type="submit">Enviar Comentário</button>
                                </form>
                            </div>
                        </div>
                    <script src="assets/javascript/comment.js"></script>
                </div>
            </div>
        </div>
        <?php
        }
        ?>  
</body>
</html>