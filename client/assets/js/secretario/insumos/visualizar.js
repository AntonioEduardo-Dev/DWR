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

            $("#ver_nome_insumo").val(dados.nome);
            $("#ver_categoria_insumo").val(dados.categoria);
            $("#ver_disponibilidade_insumo").prop('checked', dados.disponibilidade == 1);
            $("#ver_descricao_insumo").val(dados.descricao);
            $("#ver_imagem_insumo").val(dados.imagem);

            listar();
        }
    });
}

consultar();