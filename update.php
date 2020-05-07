<?php
  $id = $_GET['id'];

  include "banco.php";
   $pdo = Banco::conectar();
   $sql= "SELECT * FROM devedores WHERE id = ".$id;

foreach($pdo->query($sql) as $row) {

       $dados = array(
           'id' => $row['id'],
           'nome' => $row['nome'],
           'datanascimento' => $row['datanascimento'],
           'cpf' => $row['cpf'],
           'endereco' => $row['endereco'],
           'descricao' => $row['descricao'],
           'valor' => $row['valor'],
           'datavencimento' => $row['datavencimento']
       );

    }

echo json_encode($dados);

      if (isset ($_GET['atualizar'])) {
           $id = $_GET['id'];
           $nome = $_POST['nome'];
           $datanascimento = $_POST['datanascimento'];
           $cpf = $_POST['cpf'];
           $endereco = $_POST['endereco'];
           $descricao = $_POST['descricao'];
           $valor = $_POST['valor'];
           $datavencimento = $_POST['datavencimento'];

           $pdo = Banco::conectar();

           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql = "UPDATE devedores SET nome = ? ,datanascimento = ?,cpf = ?,endereco = ?,descricao = ?,valor = ?,datavencimento = ? WHERE id = ".$id;
           $q = $pdo->prepare($sql);
           $q->execute(array($nome,  $datanascimento, $cpf, $endereco,
            $descricao,$valor,$datavencimento));
        // var_dump($q);
          //exit();

       }

 ?>




