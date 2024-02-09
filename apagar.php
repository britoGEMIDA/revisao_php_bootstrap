<!-- Digite aqui (apagar.php) -->
<!-- 5º Arquivo a ser digitado -->
<?php
// conexão com banco de dados
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $query_usuario = "DELETE FROM usuarios WHERE id=:id";
    $del_usuario = $conn->prepare($query_usuario);
    $del_usuario->bindParam(':id', $id);

    if ($del_usuario->execute()) {

        $query_endereco = "DELETE FROM enderecos WHERE usuario_id=:usuario_id";
        $del_endereco = $conn->prepare($query_endereco);
        $del_endereco->bindParam(':usuario_id', $id);

        if ($del_endereco->execute()) {
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário deletado com sucesso!</div>"];
        } else {
            // Se o usuário foi editado, mas o endereço não 
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário apagado, endereço não apagado!</div>"];
        }
        
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não apagado, endereço não apagado!</div>"];
    }
} else {
    // Erro com ID
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>"];
}

echo json_encode($retorna);