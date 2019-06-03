<?php

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$msgSucesso = "<h1>Usuário autenticado com sucesso!</h1>";
$msgErro = "<h1>Usuário não autorizado!</h1>";
$linkVoltar = "<a href='index.html'>Voltar</a>";

if (!isset($usuario) || !isset($senha)) {
    echo $msgErro . $linkVoltar;
} else {    

    $servidor_db = "localhost";
    $usuario_db = "root";
    $senha_db = "root";
    $nome_db = "siteinsegurodb";
    
    $conn = new mysqli($servidor_db, $usuario_db, $senha_db, $nome_db);
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Falha ao conectar com o banco de dados: " . $conn->connect_error);
    }

    $hashSenha = md5($senha);

    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$hashSenha'";

    echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo $msgSucesso . $linkVoltar;
    } else {
        echo $msgErro . $linkVoltar;
    }

    $result->close();
    $conn->close();
}