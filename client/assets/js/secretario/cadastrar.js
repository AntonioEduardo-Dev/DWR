function cadastrar()
{
    var dados = {
        funcionalidade : "cadastarInsumo",
        nome : $("#nome_insumo").val(),
        categoria : $("#categoria_insumo").val(),
        disponibilidade : $('#disponibilidade_insumo').is(':checked') ? 'sim' : 'nao',
        descricao : $("#descricao_insumo").val(),
        img : $("#imagem_insumo").val(),
    };

    var i = $(`#icone_cadastrar`);
    var button = $(`#cadastrar_insumo`);
    
    button.prop('disabled', true);
    i.removeClass().addClass('fas fa-sync-alt fa-spin');

    var url = base_url + 'index.php';

    $.ajax({
        url,
        method: 'POST',
        data: dados,
        headers
    })
    .done(function( retorno ) {
        var retorno = JSON.parse(retorno);

        button.prop('disabled', false);
        i.removeClass().addClass(`fas fa-sign-in-alt`);
        
        if (retorno.type == 'error') {
            alert(retorno.message);
        } else if (retorno.type == 'warning') {
            alert(retorno.message);
        } else {
            alert(retorno.message);

            $("#nome_insumo").val('');
            $("#categoria_insumo").val('');
            $("#disponibilidade_insumo").val('');
            $("#descricao_insumo").val('');
            $("#imagem_insumo").val('');

            listar();
        }
    });
}

$('#cadastrar_insumo').click(function() {
    cadastrar();
});