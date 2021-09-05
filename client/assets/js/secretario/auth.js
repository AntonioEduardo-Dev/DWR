const auth_url = '../../../api/';

function logar() 
{
    var button = $("#btn-login");

    var dados = {
        loginAdmin : true,
        email : $("#email_usuario").val(),
        senha : $("#senha_usuario").val(),
    };

    var i = $(`#icon-login`);

    button.prop('disabled', true);
    i.removeClass().addClass('fas fa-sync-alt fa-spin');

    var url = auth_url.concat("index.php");
    
    $.ajax({
        url,
        method: 'POST',
        data: dados
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
            $("#email_usuario").val('');
            $("#senha_usuario").val('');

            var dados = retorno.data;
            localStorage.setItem("dwr_JWT", dados.JWT_token);

            alert('Login realizado');

            window.location = "home.html";
        }
    });
}

$("#btn-login").click(function() { logar(); });

document.addEventListener('keyup', (e) => {
    if (e.keyCode === 13) {
        logar();
    } 
});