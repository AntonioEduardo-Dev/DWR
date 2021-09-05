function listagemInsumos(dados)
{
    return `
        <tr>
            <td>${dados.id}</td>
            <td>${dados.nome}</td>
            <td>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="check_insumo_${dados.id}" value="option3">
                    <label for="check_insumo_${dados.id}" class="custom-control-label"></label>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Visualizar" onclick="visualizar(${dados.id})">
                    <i class="far fa-eye"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Editar" onclick="editar(${dados.id})">
                    <i class="far fa-edit"></i>
                </button>
            </td>
        </tr>
    `;
}