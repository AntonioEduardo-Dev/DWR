function listagemInsumos(dados)
{
    return `
        <tr>
            <td>${dados.id}</td>
            <td>${dados.nome}</td>
            <td>${dados.disponibilidade == 1 ? 'Disponível' : 'Indisponível'}</td>
            <td>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Visualizar" onclick="visualizar(${dados.id})">
                    <i class="far fa-eye"></i>
                </button>
                <a type="button" class="btn btn-tool" title="Editar" href="editar_insumo.html?id=${dados.id}">
                    <i class="far fa-edit"></i>
                </a>
            </td>
        </tr>
    `;
}