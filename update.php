<?php
  $id = $_GET['id'];

  include "banco.php";
   $pdo = Banco::conectar();
   $sql= "SELECT * FROM usuarios WHERE id = ".$id;

foreach($pdo->query($sql) as $row) {

       $dados = array(
           'id' => $row['id'],
           'nome' => $row['nome'],
           'sobrenome' => $row['sobrenome'],
           'telefone' => $row['telefone'],
           'rg' => $row['rg'],
           'cpf' => $row['cpf'],
           'datanascimento' => $row['datanascimento']
       );

    }

echo json_encode($dados);

      if (isset ($_GET['atualizar'])) {
           $id = $_GET['id'];
           $nome = $_POST['nome'];
           $sobrenome = $_POST['sobrenome'];
           $telefone = $_POST['telefone'];
           $rg = $_POST['rg'];
           $cpf = $_POST['cpf'];
           $datanascimento = $_POST['datanascimento'];

           $pdo = Banco::conectar();

           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql = "UPDATE usuarios SET nome = ? ,sobrenome = ?,telefone = ?,rg = ?,cpf = ?,datanascimento = ? WHERE id = ".$id;
           $q = $pdo->prepare($sql);
           $q->execute(array($nome, $sobrenome, $telefone, $rg, $cpf, $datanascimento));
          var_dump($q);
          exit();

       }

 ?>




