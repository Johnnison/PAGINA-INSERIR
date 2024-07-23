<?php
$diretorio = 'uploads';

// Verifica se o diretório já existe
if (!is_dir($diretorio)) {
    // Cria o diretório se não existir
    mkdir($diretorio, 0777, true); // Permissões 0777 para permitir leitura e escrita (adaptar conforme necessário)
    echo "Diretório '$diretorio' criado com sucesso!";
} else {
    echo "Diretório '$diretorio' já existe.";
}
?>