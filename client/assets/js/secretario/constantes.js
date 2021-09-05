if (localStorage.getItem("dwr_JWT") != null) {
    const payload = (localStorage.getItem("dwr_JWT")).split('.')[1];
    
    var key = JSON.parse(atob(payload))['dados']['id'] + '/';

    // var nome_usuario = JSON.parse(atob(payload))['dados']['nome'];
} else {
    var key = '0/';
}

const id = key;
const base_url = "../../../api/";
const prefixo = "pages/";
const usuario = "admin/";

const headers = {
    'Authorization': 'Bearer ' + localStorage.getItem('dwr_JWT')
};

const sucesso = 'success';
const erro = 'error';
const atencao = 'warning';

const sem_dados = "Nenhum Registro Encontrado";