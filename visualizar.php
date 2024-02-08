<!-- Digite aqui (visualizar.php) -->
<!-- 2º Arquivo a ser digitado -->
<?php
include_once "conexao.php";

$id = filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $query_usuario = "SELECT usr.id, usr.nome, usr.email, FROM usuarios AS usr
    LEFT JOIN enderecos AS ende ON ende.usuario_id=usr.id WHERE usr.id=:id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->bindParam(':id', $id);
$result_usuario->execute();

if (($result_usuari) and ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    $retorna = ['status' => true, 'dados' => $row_usuario];
} else {
    $retorna = [ 'status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}
} else {
    $retorna = [ 'status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);