const base_url = "../../../api/";
const prefixo = "pages/";
const usuario = "user/";

const headers = {
    'Authorization': 'Bearer ' + localStorage.getItem('dwr_JWT')
};

const sucesso = 'success';
const erro = 'error';
const atencao = 'warning';

const sem_dados = "Nenhum Registro Encontrado";