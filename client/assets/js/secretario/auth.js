const auth_url = '../../../api/';

function validar_login(login = false)
{    
    $.ajax({
        url : auth_url.concat(`admin/validar_token/${localStorage.getItem('dwr_JWT')}`),
        method: 'GET',   
    }) 
    .done(function( retorno ) {
        if (retorno.tipo == 'error') {
            if (!login) {
                redirectLogout();
            }
        } else if (login) {
            window.location = prefixo + "home.html";
        } else {
            $(".box-validando-login").fadeOut('slow');
        }
    });
}

function redirectLogout() 
{
    window.location = 'entrar';
    localStorage.removeItem('dwr_JWT');
}


function logar() 
{
    var button = $("#btn-login");

    var dados = {
        login : $("#email_usuario").val(),
        senha : $("#senha_usuario").val(),
        recaptcha : $('.g-recaptcha-response').val()
    };

    var i = $(`#icon-login`);

    button.prop('disabled', true);
    i.removeClass().addClass('fas fa-sync-alt fa-spin');

    $.post(auth_url.concat("admin/login"), JSON.stringify(dados), function(retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(`fas fa-sign-in-alt`);

        grecaptcha.reset();

        if (retorno.tipo == 'erro') {
            $.growl.error( {message : retorno.resposta} );
        } else if (retorno.tipo == 'warning') {
            $.growl.warning( {message : retorno.resposta} );
        } else {
            $("#email_usuario").val('');
            $("#senha_usuario").val('');

            var dados = retorno.resposta;

            localStorage.setItem("dwr_JWT", dados.JWT_token);

            $.growl.notice( {message : 'Login realizado!'} );

            window.location = 'home';
        }
    });
}

$("#btn-login").click(function() { logar(); });

document.addEventListener('keyup', (e) => {
    if (e.keyCode === 13) {
        logar();
    } 
});