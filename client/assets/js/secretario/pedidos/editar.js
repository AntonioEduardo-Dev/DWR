function editarStatusPedido(id, status)
{
    var url = base_url + 'index.php';

    var dados = {
        funcionalidade : "editarStatusPedido",
        id,
        status,
    };

    $.ajax({
        url,
        method: 'POST',
        data: dados,
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
            window.location = 'listar_pedido.html';
        }
    });
}