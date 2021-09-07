function cadastrar()
{
    nomeImagem = inserirImagem();

    var dados = {
        funcionalidade : "cadastarInsumo",
        nome : $("#nome_insumo").val(),
        categoria : $("#categoria_insumo").val(),
        disponibilidade : $('#disponibilidade_insumo').is(':checked') ? 'sim' : 'nao',
        descricao : $("#descricao_insumo").val(),
        img : nomeImagem,
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
            if (nomeImagem != "imagem_indefinida.jpg") {
                apagarImagem(nomeImagem);
            }
        } else if (retorno.type == 'warning') {
            alert(retorno.message);
            if (nomeImagem != "imagem_indefinida.jpg") {
                apagarImagem(nomeImagem);
            }
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

function inserirImagem() 
{
    var prod_imagem;

    if($('#imagem_insumo')[0].files[0]) {
        var data = new FormData();
        data.append('imagemInsumoUpload', $('#imagem_insumo')[0].files[0]);
        
        $.ajax({
            async: false,
            url: '../../../api/Imagem.php',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data) 
            {
                var resultado = data.split('-|-');
                
                if (resultado[0] == "true") {
                    prod_imagem = resultado[1];
                }else {
                    prod_imagem = "imagem_indefinida.jpg";
                }
            }
        })
    }else{
        prod_imagem = "imagem_indefinida.jpg";
    }
    return (prod_imagem);
}

function apagarImagem(nomeImagem) {

    var dados = {
        apagarImagem : nomeImagem
    }
    $.post( "../../../api/Imagem.php", dados, function( data ) {});
}

$('#cadastrar_insumo').click(function() {
    cadastrar();
});