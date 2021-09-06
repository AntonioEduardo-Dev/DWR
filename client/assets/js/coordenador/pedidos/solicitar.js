function solicitar()
{
    var quantidade = $('#quantidade').val();
    var insumo = $('#insumo').val();

    if (quantidade == '' || insumo == '') {
        alert('Preencha todos os campos obrigatórios');
        return false;
    }

    var insumos = quantidade + "x " + insumo;

    var dados = {
        funcionalidade : "cadastrarPedido",
        insumos,
        observacao : $("#observacao").val(),
        senha : $('#senha').val(),
    };

    var i = $(`#icone_solicitar`);
    var button = $(`#solicitar_insumo`);
    
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
            window.location = 'listar_pedido.html';
        }
    });
}

function consultarInsumos()
{
    $(".box-icone-carregando").show();

    var url = base_url + 'index.php?funcionalidade=listarInsumos';
    
    $.ajax({
        url,
        method: 'GET',
        headers
    }) 
    .done(function( retorno ) {
        $(".box-icone-carregando").fadeOut('slow');
        var retorno = JSON.parse(retorno);

        switch (retorno.type) {
            case erro:
                alert(retorno.message)
                break;

            case atencao:
                alert(retorno.message)
                break;

            case sucesso:
                $("#insumo").html("");
                
                var insumos = retorno.data;
                
                $.each(insumos, function (idx, insumo) {
                    $("#insumo").append(optionInsumos(insumo));
                });
                break;
        }
    });
}

consultarInsumos();

$('#solicitar_insumo').click(function() {
    solicitar();
});