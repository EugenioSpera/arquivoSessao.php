<?php

session_start(); //inicia sessão
include 'conexao.php'; // inclui o arquivo de conexao com o banco de dados 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {//verefica se o método de requisiçao e POST
    $email = $_POST['email']; //obtem o valor do campo email
    $senha = $_POST['senha']; //obtem o valor do campo senha 
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    //variavel $sql recebe a consulta da tabela usuareios

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {//verifica se a consulta teve resultado
        $user = mysqli_fetch_assoc($result); //obtem os dados do usuario encontrado na consulta 
        if (password_verify($senha, $user['senha'])) { //verifica se a senha que foi digitada é a mesma do banco de dados

            $_SESSION['usuario_id'] = $user['id']; //arm,azena as informações id e nome na sessao
            $_SESSION['usuario_nome'] = $user['nome'];//Armazena o nome do usuario na sessao

            header("Location: pagina_principal.php"); // Redireciona para a página principal
            exit; // Encerra o script
        } else {
            echo "Senha incorreta"; // Mensagem de erro se a senha estiver errada
        }
    } else {
        echo "Usuário não encontrado"; // Mensagem de erro se o usuário não for encontrado

    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="././css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="container-login">

        <div class="container">

            <img src="image/Login.jpg" alt="Imagem de Login">
            <form method="post">
                Email: <input type="email" name="email" required><br><br>
                Senha: <input type="password" name="senha" required><br><br>
                <input type="submit" value="Entrar">
            </form>

            <a href="cadastro.php" class="cadastro-link">Fazer cadastro</a>
            

        </div>
    </div>

</body>

</html>