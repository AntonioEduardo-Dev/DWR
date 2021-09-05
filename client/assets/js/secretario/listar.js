function listar()
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
                $("#tbody_insumos").html("");

                var insumos = retorno.message;
                
                $.each(insumos, function (idx, insumo) {
                    $("#tbody_insumos").append(listagemInsumos(insumo));
                });

                $('#dataTable').DataTable();
                break;
        }
    });
}

listar();