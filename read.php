<?php include'banco.php';

$pdo = Banco::conectar();
$sql = 'SELECT * FROM devedores ORDER BY id DESC';

foreach($pdo->query($sql) as $row) {
    $dados = array(
        'id' => $row['id'],
        'nome' => $row['nome'],
        //'datanascimento' => $row['datanascimento'],
        'cpf' => $row['cpf'],
        //'endereco' => $row['endereco'],
        //'descricao' => $row['descricao'],
        'valor' => $row['valor'],
        //'datavencimento' => $row['datavencimento']
    );
    $retorno[] = $dados;
 
}


echo json_encode($retorno);
 //print_r($retorno);

?>

