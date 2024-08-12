<?php


include 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {//verifica se o metodo enviado é POST
    $idUsuario = $_POST['idUsuario']; //obtem o nome idUsuario
    $arquivo = $_POST['arquivo']; //obtem o caminho do arquivo do formulario    
    $sql = "INSERT INTO arquivo(idUsuario, arquivo) VALUES ('$idUsuario', '$arquivo')";
    if (mysqli_query($conn, $sql)) {// executa a consulta e verifica se foi bem sucedida

        echo " Cadastro realizado com sucesso ";

    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
 
        // Verifica se o arquivo é um PDF
        if ($fileType == 'pdf') {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "O arquivo " . basename($_FILES["file"]["name"]) . " foi enviado com sucesso.";
            } else {
                echo "Desculpe, houve um erro ao enviar o seu arquivo.";
            }
        } else {
            echo "Apenas arquivos em formato PDF são permitidos.";
        }
    } else {
        // Mostra a mensagem de erro específica
        echo "Erro no upload: " . $_FILES['file']['error'];
    }
 
} else {
    echo "Nenhum arquivo enviado.";
}
 
 
 
 
?>
 
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2; url=index.php">
    <title>Upload de Arquivo</title>
</head>
<body>
    <p>Redirecionamento para a galeria...</p>
</body>
</html>