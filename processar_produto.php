<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Configurações para o upload da imagem
    $diretorioUpload = "uploads/"; // Diretório onde as imagens serão armazenadas
    $nomeArquivo = $_FILES["imagem"]["name"]; // Nome original do arquivo
    $caminhoArquivo = $diretorioUpload . basename($nomeArquivo); // Caminho completo do arquivo

    // Move o arquivo para o diretório de upload
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
        // Dados do produto enviados pelo formulário
        $nomeProduto = $_POST["nome"];
        $descricaoProduto = $_POST["descricao"];

        // Processamento adicional (por exemplo, salvar no banco de dados)
        // Aqui você pode adicionar código para inserir os dados no banco de dados
        
        // Exemplo de mensagem de sucesso
        echo "<h2>Produto inserido com sucesso!</h2>";
        echo "<p>Nome: " . htmlspecialchars($nomeProduto) . "</p>";
        echo "<p>Descrição: " . htmlspecialchars($descricaoProduto) . "</p>";
        echo "<p>Imagem: <img src='$caminhoArquivo' alt='Imagem do Produto'></p>";
    } else {
        // Caso ocorra algum erro no upload da imagem
        echo "<h2>Erro ao realizar o upload da imagem.</h2>";
    }
}
?>
