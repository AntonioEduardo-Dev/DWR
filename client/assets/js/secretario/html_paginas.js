var status_pedidos = {
    'pendente' : 'warning',
    'aprovado' : 'info',
    'finalizado' : 'success',
    'recusado' : 'danger',
}

function listagemInsumos(dados)
{
    return `
        <tr>
            <td>${dados.id}</td>
            <td>${dados.nome}</td>
            <td>${dados.disponibilidade == 1 ? 'Disponível' : 'Indisponível'}</td>
            <td>
                <a type="button" class="btn btn-tool" title="Visualizar" href="detalhe_insumo.html?id=${dados.id}">
                    <i class="far fa-eye"></i>
                </a>
                <a type="button" class="btn btn-tool" title="Editar" href="editar_insumo.html?id=${dados.id}">
                    <i class="far fa-edit"></i>
                </a>
            </td>
        </tr>
    `;
}

function listagemPedidos(dados)
{
    var acoes = '-';

    if (dados.status == 'pendente') {
        acoes = `
            <button type="button" class="btn btn-tool" title="Aprovar" onclick="editarStatusPedido(${dados.id}, 'aprovado')">
                <i class="far fa-check-circle"></i>
            </button>
            <button type="button" class="btn btn-tool" title="Recusar" onclick="editarStatusPedido(${dados.id}, 'recusado')">
                <i class="far fa-times-circle"></i>
            </button>
        `;
    } else if (dados.status == 'aprovado') {
        acoes = `
            <button type="button" class="btn btn-tool" title="Finalizar" onclick="editarStatusPedido(${dados.id}, 'finalizado')">
                <i class="far fa-check-circle"></i>
            </button>
        `;
    }

    return `
        <tr>
            <td>${dados.id}</td>
            <td>${dados.id_user_fk}</td>
            <td>${dados.insumos}</td>
            <td>${botaoStatus((dados.status).toUpperCase(), status_pedidos[dados.status])}</td>
            <td>${dados.data_hora}</td>
            <td>${acoes}</td>
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