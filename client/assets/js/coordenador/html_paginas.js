var status_pedidos = {
    'pendente' : 'warning',
    'aprovado' : 'info',
    'finalizado' : 'success',
    'recusado' : 'danger',
}

var status_insumos = {
    1 : 'success',
    0 : 'danger',
}

function listagemInsumos(dados)
{
    return `
        <tr>
            <td>${dados.id}</td>
            <td>${dados.nome}</td>
            <td>${botaoStatus(dados.disponibilidade == 1 ? 'Disponível' : 'Indisponível', status_insumos[dados.disponibilidade])}</td>
            <td>
                <a type="button" class="btn btn-tool" title="Visualizar" href="detalhe_insumo.html?id=${dados.id}">
                    <i class="far fa-eye"></i>
                </a>
            </td>
        </tr>
    `;
}

function listagemPedidos(dados)
{
    return `
        <tr>
            <td>${dados.id}</td>
            <td>${dados.insumos}</td>
            <td>${botaoStatus((dados.status).toUpperCase(), status_pedidos[dados.status])}</td>
            <td>${dados.data_hora}</td>
        </tr>
    `;
}

function botaoStatus(texto, cor)
{   
    return `
        <span class="badge badge-${cor}">
            ${texto}
        </span>
    `;
}

function optionInsumos(dados)
{
    return `
        <option value="${dados.nome}">
            ${dados.nome}
        </option>
    `;
}