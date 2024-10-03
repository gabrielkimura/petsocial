<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Posts</title>
    <link rel="stylesheet" type="text/css" href="assets/css/menu-lateral.css">
    <link rel="stylesheet" type="text/css" href="assets/css/post.css">
    <link rel="stylesheet" type="text/css" href="assets/css/button-plus.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
<?php include("./assets/css/menu.php");?>
    <?php
        require_once "./configs/connection.php";
        $db = Database::connection();
        $sql = "SELECT p.userId AS id, p.descricao AS descricao, u.usuario AS usuario, p.image1 AS image1, p.image2 AS image2, u.tipoUser AS tipo 
            FROM post p JOIN user u ON p.userId = u.userId WHERE u.usuario = 'anamaria.souza';";
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
            </div>
            </div>
        <?php
        }
        ?> 
    <!-- iniciando e fechando pop-up -->
    <a href="#" class="float-button">
        <img src="assets/img/plusicon.png" alt="Mais">
    </a>
    <!-- Modal de novo post -->
    <div id="new-post-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Novo Post</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" cols="250"></textarea><br><br>

                <label for="file-upload" class="custom-file-upload-one">
                    Selecione imagem 1 </label>
                <input id="file-upload" type="file" name="img1" style="display: none;" /><br>
                <label for="file-upload" class="custom-file-upload-two">
                    Selecione imagem 2 (opcional) </label>
                <input id="file-upload" type="file" name="img2" style="display: none;" /><br><br><br>
                
                <div class="button-container">
                    <button type="submit" name="btn-submit">Enviar</button>
                </div>
            </form>
            <!-- PHP E LOGICA DE ENVIO PARA O BANCO -->
            <?php
                if (isset($_POST["btn-submit"])){
                    $descricao = $_POST['descricao'];
                    $img1 = $_FILES['img1'];
                    $img2 = $_FILES['img2'];
                    $arquivosPermitidos = ["png", "jpg", "jpeg"];
                    $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                    $caminho = "imagens/fisico/";
                    $tamanhoMaximo = 1024 * 1024 * 10; //10MB
                    
                    //verificacao arquivo 1
                    if (!empty($_FILES['img1']['name'])){
                        $nomeArquivo1 = $_FILES['img1']['name'];
                        $tipo1 = $_FILES['img1']['type'];
                        $nomeTemporario1 = $_FILES['img1']['tmp_name'];
                        $tamanho1 = $_FILES['img1']['size'];
                        $erros1 = array();

                        if($tamanho1 > $tamanhoMaximo){
                            $erros1[] = "Arquivo excede o tamanho máximo!";
                        }
                        if(!in_array($tipo1, $typesPermitidos)){
                            $erros1[] = "Arquivo não permitido!";
                        }

                        if(!empty($erros1)){
                            foreach ($erros1 as $erro1){
                                echo $erro1;
                            }
                        }else{
                            move_uploaded_file ($nomeTemporario1, $caminho.$nomeArquivo1);
                        }
                    }
                    //verificacao arquivo 2
                    if (!empty($_FILES['img2']['name'])){
                        $nomeArquivo2 = $_FILES['img2']['name'];
                        $tipo2 = $_FILES['img2']['type'];
                        $nomeTemporario2 = $_FILES['img2']['tmp_name'];
                        $tamanho2 = $_FILES['img2']['size'];
                        $erros2 = array();

                        if($tamanho2 > $tamanhoMaximo){
                            $erros2[] = "Arquivo excede o temanho máximo!";
                        }
                        if(!in_array($tipo2, $typesPermitidos)){
                            $erros2[] = "Arquivo não permitido!";
                        }

                        if(!empty($erros2)){
                            foreach ($erros2 as $erro2){
                                echo $erro2;
                            }
                        }else{
                            move_uploaded_file ($nomeTemporario2, $caminho.$nomeArquivo2);
                        }
                    }
                    if($descricao != '' && $_FILES['img1']['name'] != ''){
                        try {
                            $sql = "INSERT INTO post (userId, descricao, image1, image2)
                            VALUES (1, '$descricao', '$caminho.$nomeArquivo1', '$caminho$nomeArquivo2')";
    
                            $consulta = $db -> query($sql);
    
                            if($consulta){
                                $insert_materia = 'Answer sent successfuly!';
                            }else{
                                $insert_materia = 'Failed to sent the answer - Error';
                            }
                        }catch(Exception $e){
                            echo $e->getMessage();
                        }
                    }else{
                        echo '<div class="d-flex justify-content-center mt-5">
                        <div class="alert alert-danger div-bloco">Fill all of the fields, please.</div>
                        </div>';
                    }
                }
            ?>
        </div>
    </div>
    <!-- scrip js -->
    <script src="assets/javascript/new-post.js"></script>
</body>
</html>