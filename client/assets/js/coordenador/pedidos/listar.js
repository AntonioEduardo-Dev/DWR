function listar()
{
    $(".box-icone-carregando").show();

    var url = base_url + 'index.php?funcionalidade=listarPedidosUser';

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
                $("#tbody_pedidos").html("");
                
                var pedidos = retorno.data;

                $.each(pedidos, function (idx, pedido) {
                    $("#tbody_pedidos").append(listagemPedidos(pedido));
                });
                break;
        }
    });
}

listar();