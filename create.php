<?php
        require "banco.php";
        if(!empty($_POST)){

        $nome = trim($_POST['nome']);
        $datanascimento = $_POST['datanascimento'];
        $cpf = trim($_POST['cpf']);
        $endereco = $_POST['endereco'];
        $descricao = trim($_POST['descricao']);
        $valor = $_POST['valor'];
        $datavencimento = $_POST['datavencimento'];
       
       

	
	



	
		$pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			
	
		$sql = "INSERT INTO devedores(nome,datanascimento,cpf,endereco,descricao,valor,datavencimento)VALUES(?,?,?,?,?,?,?)";

		$q = $pdo->prepare($sql);
		

		$q->execute(array($nome,$datanascimento,$cpf,$endereco,$descricao,$valor,$datavencimento));
		
		
		Banco::desconectar();

			
	}
	



