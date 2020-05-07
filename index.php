<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>CRUD</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.js"></script>
    <script src="js/jquery-ui.js"></script>

</head>

<script type="text/javascript">


    // funcao editar
   function editar(id){

       $.post('update.php?id='+id,function(data){
          // $('#dlgUsuarios').hide();
            data = $.parseJSON(data);
            $('#id').val(id);
            $('#nome').val(data.nome);
            $('#datanascimento').val(data.datanascimento);
            $('#cpf').val(data.cpf);
            $('#endereco').val( data.endereco);
            $('#descricao').val( data.descricao);
            $('#valor').val( data.valor);
            $('#datavencimento').val( data.datavencimento);
            $('#btnCadastrar').html('Editar');
            $('#dlgUsuarios').show();




        });


    }
    $(function(){

        listaUsuarios();

    });

    $(function(){


        $("#datanascimento").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    });

    $(function(){


        $("#datavencimento").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    });


    



    function listaUsuarios(){
        $.get('read.php',function(data){
            data = $.parseJSON(data);
            for(i=0;i<data.length;i++){
               linha = montarLinha(data[i]);


                $('#tabUsuarios>tbody').append(linha);
            }
        });
    }

    function montarLinha(p){
        var linha = "<tr>" +
            "<td>" + p.id +
            "<td>" + p.nome +
            //"<td>" + p.datanascimento +
            "<td>" + p.cpf +
            //"<td>" + p.endereco +
            //"<td>" + p.descricao +
            "<td>" + p.valor +
            //"<td>" + p.datavencimento +
            '<td>' + '<button class="btn btn-primary btn-small" onclick="editar(' +p.id+')" style=margin-right:10px;>Editar </button>' +
            '<button class="btn btn-danger btn-small" onclick="remover(' +p.id+')">Deletar </button>';
        return linha;

    }



    function novoUsuario(){
        $('#dlgUsuarios').show();

    }


    ///form usuarios salvar
    function teste() {
        ///form Usuarios salvar
        $("#formUsuarios").submit( function(event){
            event.preventDefault();
            if($('#id').val() != ''){

                salvarUsuarios();
            }else{
                criarUsuario();
                //location.reload();
            }
        });
    }

    ///function criar usuarios
    function criarUsuario() {
        user = {
            nome: $("#nome").val(),
            datanascimento: $("#datanascimento").val(),
            cpf: $("#cpf").val(),
            endereco: $("#endereco").val(),
            descricao: $("#descricao").val(),
            valor: $("#valor").val(),
            datavencimento: $("#datavencimento").val()
            
        };
        gravar(user);


    }

    function gravar(user){
        $.ajax({
            type:'POST',
            url: "create.php",
            //async:false,
            data:user,
            datatype:'json',

            success:function(event){
                event = "Gravado com sucesso!";
                location.reload();
             // console.log(event);
              // return event ;
            }


        });

        $('#dlgUsuarios').hide();
    }

    ///deletar o usuario
    function remover(id){
        $.ajax({
            type:'POST',
            url:"delete.php?id=" + id,
            context:'this',
            success:function(e){
                var linha = $('#tabProdutos>tbody>tr');
                e = linha.filter(function(i,elemento){
                    return elemento.cells[0].textContent == id;
                });

                if(e){
                    e.remove();
                }
            },
            error:function(error){

            }

        });
        location.reload();
    }

    ///update dos usuarios
    function salvarUsuarios(){

        user = {
            id : $('#id').val(),
            nome: $("#nome").val(),
            datanascimento: $("#datanascimento").val(),
            cpf: $("#cpf").val(),
            endereco: $("#endereco").val(),

            descricao: $("#descricao").val(),
            valor: $("#valor").val(),
            datavencimento: $("#datavencimentocimento").val()

        };

        $.ajax({
            type: "POST",
            url: "update.php?atualizar&id=" + user.id,
            context: this,
            data: user,
            success: function(data) {

                linha = $('#tabUsuarios>tbody>tr');
                e = linha.filter(function(i,e){
                    return e.cells[0].textContent == user.id;
                });

                if (e) {
                    e[0].cells[0].textContent = user.id;
                    e[0].cells[1].textContent = user.nome;
                    e[0].cells[2].textContent = user.datanascimento;
                    e[0].cells[3].textContent = user.cpf;
                    e[0].cells[4].textContent = user.endereco;
                    e[0].cells[5].textContent = user.descricao;
                    e[0].cells[6].textContent = user.valor;
                    e[0].cells[7].textContent = user.datavencimento;

                }
                $('#dlgUsuarios').hide();
                location.reload();

            },
            erro:function(){
               return "erro de código";
            }
        });

    }

    function fechar(){
        $('#formUsuarios').submit(function(event){
            event.preventDefault();

            $('#dlgUsuarios').hide();

        });
        location.reload();
    }



</script>
<body>
	<div class="container">
		<div class="row">
			<div class="jumbotron col-10">
			<h5>CRUD em PHP - Ronivaldo Santos Souza</h5>
			</div>
		</div>

		<div class="row">
            <button class="btn btn-primary" role="button" onclick="novoUsuario()">Cadastrar</button>
        </div>
            <div class="row">
            <div class="card border">
                <div class="card-body">
                    <h5 class="card-title">Lista de Devedores</h5>
                    <table id="tabUsuarios" class="table table-ordered table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <!-- <th>Nascimento</th>-->
                            <th>CPF</th>
                            <!--<th>Endereço </th>-->
                            <th>Valor</th>
                            <!--<th>Vencimento</th>
                            <th>Ações</th> -->
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

            </div>

            <div class="modal" tabindex="-1" role="dialog" id="dlgUsuarios">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" id="formUsuarios">
                            
                            <div class="modal-body">

                                <input type="hidden" id="id" class="form-control">
                                <div class="form-group">
                                    <label for="nome" class="control-label">Nome do Devedor</label>
                                    <div class="input-group">
                                        <input type="text" name="nome" class="form-control col-12" id="nome" value="" placeholder="Nome do Devedor">
                                        
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="datanascimento" class="control-label">Data de nascimento</label>
                                    <div class="input-group">

                                        <p><input type="text" id="datanascimento" placeholder="03/04/1988"></p>
                                    </div>

                                <div class="form-group">
                                    <label for="cpf" class="control-label">CPF</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cpf" placeholder="Seu CPF">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco" class="control-label">Endereço</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="endereco" placeholder="Seu Endereço">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="descricao" class="control-label">Descricao</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="descricao" placeholder="Descrição"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="valor" class="control-label">Valor</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="valor" placeholder="R$">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="datavencimento" class="control-label">Data de Vencimento</label>
                                    <div class="input-group">

                                        <p><input type="text" id="datavencimento" placeholder="nesse formato 03/04/1988"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button onclick="teste()" id="btnCadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
                                <button onclick="fechar()" type="button" id="btnCancelar" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

		</div>
	</div>


</body>

</html>
