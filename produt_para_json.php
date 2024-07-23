<?php
// Caminho para o arquivo JSON de produtos
$arquivoJSON = 'produtos.json';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do produto enviados pelo formulário
    $nomeProduto = $_POST["nome"];
    $descricaoProduto = $_POST["descricao"];
    $nomeArquivo = $_FILES["imagem"]["name"];
    $caminhoArquivo = "caminho/para/uploads/" . basename($nomeArquivo);

    // Move o arquivo para o diretório de upload
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
        // Cria um array com os dados do novo produto
        $novoProduto = array(
            "id" => uniqid(), // Gera um ID único para o produto
            "nome" => $nomeProduto,
            "descricao" => $descricaoProduto,
            "imagem" => $caminhoArquivo
        );

        // Lê o arquivo JSON existente
        $dadosJSON = file_get_contents($arquivoJSON);
        $produtos = json_decode($dadosJSON, true);

        // Adiciona o novo produto ao array de produtos
        $produtos["produtos"][] = $novoProduto;

        // Converte de volta para JSON
        $jsonAtualizado = json_encode($produtos, JSON_PRETTY_PRINT);

        // Escreve o JSON atualizado de volta ao arquivo
        if (file_put_contents($arquivoJSON, $jsonAtualizado)) {
            // Exemplo de mensagem de sucesso
            echo "<h2>Produto inserido com sucesso!</h2>";
            echo "<p>Nome: " . htmlspecialchars($nomeProduto) . "</p>";
            echo "<p>Descrição: " . htmlspecialchars($descricaoProduto) . "</p>";
            echo "<p>Imagem: <img src='$caminhoArquivo' alt='Imagem do Produto'></p>";
        } else {
            echo "<h2>Erro ao salvar os dados do produto.</h2>";
        }
    } else {
        echo "<h2>Erro ao realizar o upload da imagem.</h2>";
    }
}
?>