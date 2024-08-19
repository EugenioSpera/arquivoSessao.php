<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['document'])) {
    if ($_FILES['document']['error'] == UPLOAD_ERR_OK) {
        require 'conexao.php';
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["document"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verifica se o arquivo é um PDF
        if ($fileType === 'pdf') {
            if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
                $user_id = $_SESSION['usuario_id'];
                $stmt = $conn->prepare("INSERT INTO arquivo (idUsuario, arquivo) VALUES (?, ?)");
                if ($stmt) {
                    $stmt->bind_param("is", $user_id, $target_file);
                    if ($stmt->execute()) {
                        echo "O arquivo " . htmlspecialchars(basename($_FILES["document"]["name"])) . " foi enviado com sucesso.";
                    } else {
                        echo "Erro ao salvar no banco de dados: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Erro ao preparar a consulta: " . $conn->error;
                }
            } else {
                echo "Desculpe, houve um erro ao enviar o seu arquivo.";
            }
        } else {
            echo "Apenas arquivos PDF são permitidos.";
        }
    } else {
        echo "Erro no upload: " . $_FILES['document']['error'];
    }
} else {
    echo "Nenhum arquivo enviado.";
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta http-equiv="refresh" content="2; url=pagina_principal.php">
    <title>Upload de Documento</title>
</head>

<body>
    <p>Redirecionando para a lista de documentos...</p>
</body>

</html>