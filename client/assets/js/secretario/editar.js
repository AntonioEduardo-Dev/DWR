var id_insumo;

function consultar()
{
    var url_parametros = new URLSearchParams(window.location.search);
    id_insumo = url_parametros.get('id');

    var url = base_url + 'index.php?funcionalidade=listarInsumos&id='+id_insumo;

    $.ajax({
        url,
        method: 'GET',
        headers
    })
    .done(function( retorno ) {
        var retorno = JSON.parse(retorno);
        
        if (retorno.type == 'error') {
            alert(retorno.message);
        } else if (retorno.type == 'warning') {
            alert(retorno.message);
        } else {
            var dados = retorno.data;

            $("#editar_nome_insumo").val(dados.nome);
            $("#editar_categoria_insumo").val(dados.categoria);
            $("#editar_disponibilidade_insumo").prop('checked', dados.disponibilidade == 1);
            $("#editar_descricao_insumo").val(dados.descricao);
            $("#editar_imagem_insumo").val(dados.imagem);

            listar();
        }
    });
}

function editar()
{
    var url = base_url + 'index.php';

    var dados = {
        funcionalidade : "editarInsumo",
        id : id_insumo,
        nome : $("#editar_nome_insumo").val(),
        categoria : $("#editar_categoria_insumo").val(),
        disponibilidade : $("#editar_disponibilidade_insumo").is(':checked') ? 'sim' : 'nao',
        descricao : $("#editar_descricao_insumo").val(),
        img : $("#editar_imagem_insumo").val(),
    };

    $.ajax({
        url,
        method: 'PUT',
        dados,
        headers
    })
    .done(function( retorno ) {
        var retorno = JSON.parse(retorno);
        
        if (retorno.type == 'error') {
            alert(retorno.message);
        } else if (retorno.type == 'warning') {
            alert(retorno.message);
        } else {
            alert(retorno.message);

            var dados = retorno.data;

            $("#editar_nome_insumo").val(dados.nome);
            $("#editar_categoria_insumo").val(dados.categoria);
            $("#editar_disponibilidade_insumo").prop('checked', dados.disponibilidade == 'sim');
            $("#editar_descricao_insumo").val(dados.descricao);
            $("#editar_imagem_insumo").val(dados.imagem);

            listar();
        }
    });
}

consultar();