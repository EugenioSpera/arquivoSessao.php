<?php
session_start();// Inicia uma nova sessão ou retoma a sessão existente
 
// Verifica se o usuário está logado
//Verifica se a variável de sessão usuario_id está definida.
//Se não estiver, significa que o usuário não está logado.
if (!isset($_SESSION['usuario_id'])) {
    //Esta função é usada para enviar cabeçalhos HTTP brutos diretamente ao navegador.
   // o servidor envia um cabeçalho HTTP ao navegador, instruindo-o a carregar a página index.php
    header("Location: index.php");
    //finaliza o script. Por segurança.
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container-principal" >
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
    <p>Você está logado.</p>
    <a href="logout.php">Sair</a>

    <div class="arquivo-area" >

    <h1>Armazenador de Arquivos:</h1>

    <form action="upload_arquivo.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="file/*" class="file_customizada">
        <button type="submit">Enviar Arquivo</button>
    </form>

    </div>

    <div class="gallery">
        <?php

        $files = glob("uploads/*.*");
        foreach ($files as $file) {
            echo '<img src="' . $file . '" alt="Imagem">';
        }
        ?>
    </div>

    </div>
</body>
</html>