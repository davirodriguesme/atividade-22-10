<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionário</title>
    <link rel="stylesheet" href="Untitled-1.css">
</head>
<body>

<?php
// Incluir o arquivo de conexão
include('conexao.php');

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    // Verificar se os campos obrigatórios estão preenchidos
    if (!empty($nome) && !empty($telefone)) {
        // Inserir dados na tabela funcionarios
        $sql = "INSERT INTO funcionarios (fun_numero, fun_telefone, fun_nome) VALUES (?, ?, ?)";

        // Preparar a consulta SQL para evitar SQL Injection
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind de variáveis
            $stmt->bind_param("iss", $codigo, $telefone, $nome);

            // Executar a query
            if ($stmt->execute()) {
                echo "Dados inseridos com sucesso!";
            } else {
                echo "Erro ao inserir os dados: " . $stmt->error;
            }

            // Fechar o statement
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $mysqli->error;
        }
    } else {
        echo "Por favor, preencha todos os campos!";
    }
}

// Fechar a conexão com o banco de dados (opcional, pois será encerrada automaticamente no fim do script)
$mysqli->close();
?>

    <h3 class="ins">Insira suas informações</h3>
    <form action="" method="POST" class="form">
        <p>Código: <input type="text" name="codigo" id="codigo" class="insert"></p>
        <p>Nome: <input type="text" name="nome" id="nome" class="insert" required></p>
        <p>Telefone: <input type="text" name="telefone" id="telefone" class="insert" required></p>
        <p><input type="submit" value="Enviar"></p>
    </form>
</body>
</html>
