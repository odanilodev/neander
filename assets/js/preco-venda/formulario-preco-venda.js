var baseUrl = $('.base-url').val();

$(function () {

    $('.input_porcentagem_disabled').prop('disabled', true);

    $('.select2').select2({
        theme: 'bootstrap-5'
    });

});

$(document).on('click', '.btn_duplica_div', function () {
    duplicarCamposPrecoVenda();
    carregaSelect2('select2');
});

function duplicarCamposPrecoVenda() {

    let optionsSelectProjeto = $('#select_projetos_cliente').html();

    // HTML para os selects de projeto e lote
    let selectsHtml = $(`
        <div class="div_selects_preco_venda row-selects-preco-venda row mb-3">
            <div class="div_selects_preco_venda col-md-3 div_select_projeto_cliente">
                <label for="select_projetos_cliente" class="form-label">Projeto</label>
                <select class="form-select select2 select_projetos_cliente" name="select_projetos_cliente">
                    ${optionsSelectProjeto}
                </select>
            </div>
            <div class="div_selects_preco_venda col-md-3 div_select_valor_lote">
                <label for="select_lote_projeto" class="form-label">Lote</label>
                <select class="form-select select2 select_lote_projeto" name="select_lote_projeto">
                    <option value="" selected disabled>Selecione o Lote</option>
                    <option value="50">Especial 50</option>
                    <option value="100">100</option>
                    <option value="340">340</option>
                    <option value="560">560</option>
                    <option value="1000">1000</option>
                </select>
            </div>

            <div class="col-md-1 ms-auto d-flex justify-content-end">
                <button class="mt-4 btn btn-phoenix-warning btn_exclue_div" style="margin-right:5px;">-</button>
                <button class="mt-4 btn btn-phoenix-success btn_duplica_div">+</button>
            </div>
        </div>
    `);

    // HTML dos campos a serem duplicados
    let camposHtml = $(`
    <div class="p-4 bg-light shadow rounded container_campos_preco_venda mb-4">
        <div class="row mb-4 rows_preco_venda">
            <input type="hidden" class="input_hidden_fator" value="1">

            <!-- Linha 1 -->
            <div class="col-md-3 div_input_preco_venda">
                <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                <textarea disabled class="form-control descricao_produto input_porcentagem_disabled" name="descricao_produto" placeholder="Digite a descrição" rows="1"></textarea>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_ncm" class="form-label">NCM</label>
                <input type="text" disabled class="form-control input_ncm text-1000" name="input_ncm">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_descricao_ncm" class="form-label">Descrição do NCM</label>
                <input type="text" disabled class="form-control input_descricao_ncm text-1000" name="input_descricao_ncm">
            </div>
            <div class="col-md-1 div_input_preco_venda">
                <label for="lote_partida" class="form-label">Lote Partida</label>
                <input type="text" disabled class="form-control lote_partida" name="lote_partida">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_custo_produto" class="form-label">Custo do Produto</label>
                <input disabled type="text" class="form-control text-1000 input_custo_produto" name="input_custo_produto">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_custo_mao_de_obra" class="form-label">Custo Mão de Obra</label>
                <input disabled type="text" class="form-control text-1000 input_custo_mao_de_obra" name="input_custo_mao_de_obra">
            </div>
        </div>

        <div class="row mb-4 rows_preco_venda">
            <!-- Linha 2 -->
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_embalagem" class="form-label">Custo Embalagem</label>
                <input disabled type="text" class="form-control text-1000 input_embalagem" name="input_embalagem">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_perda" class="form-label">Perda</label>
                <input disabled type="text" class="form-control text-1000 input_perda" name="input_perda">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_frete_porcentagem" class="form-label">Frete</label>
                <div class="input-group">
                    <input type="text" disabled class="form-control input_frete_porcentagem input_porcentagem_disabled" name="input_frete_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control input_frete_calculado text-1000" name="input_frete_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_custo_financeiro_porcentagem" class="form-label">Custo Financeiro</label>
                <div class="input-group">
                    <input type="text" disabled class="form-control input_custo_financeiro_porcentagem input_porcentagem_disabled" name="input_custo_financeiro_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control input_custo_financeiro_calculado text-1000" name="input_custo_financeiro_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_margem_porcentagem" class="form-label">Margem (% - R$)</label>
                <div class="input-group">
                    <input type="text" disabled class="form-control input_margem_porcentagem input_porcentagem_disabled" name="input_margem_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control text-1000 input_margem_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_sub_total" class="form-label">Sub-Total</label>
                <input type="text" disabled class="form-control input_sub_total text-1000" name="input_sub_total">
            </div>
        </div>

        <div class="row mb-4 rows_preco_venda">
            <!-- Linha 3 -->
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_comissao_porcentagem" class="form-label">Comissão (%)</label>
                <div class="input-group">
                    <input type="text" disabled class="form-control input_comissao_porcentagem input_porcentagem_disabled" name="comissao_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control input_comissao_calculada text-1000" name="input_comissao_calculada">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_total_sem_imposto" class="form-label">Total Sem Imposto</label>
                <input type="text" disabled class="text-1000 form-control input_total_sem_imposto" name="input_total_sem_imposto">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_imposto_porcentagem" class="form-label">Imposto (%)</label>
                <div class="input-group">
                    <input type="text" disabled class="form-control input_imposto_porcentagem input_porcentagem_disabled" name="input_imposto_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="text-1000 form-control input_imposto_calculado" name="input_imposto_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_total_unitario" class="form-label">Total Unit. (R$)</label>
                <input type="text" disabled class="text-1000 form-control input_total_unitario" name="input_total_unitario">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_st_estado_porcentagem" class="form-label">ST do Estado (%)</label>
                <div class="input-group">
                    <input type="text" disabled class="input_porcentagem_disabled form-control input_st_estado_porcentagem" name="input_st_estado_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="text-1000 form-control input_st_estado_calculado" name="input_st_estado_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda ms-auto">
                <label for="input_total_st_estado" class="form-label">Valor total com ST</label>
                <input type="text" disabled class="text-1000 form-control input_total_st_estado" name="input_total_st_estado">
            </div>
        </div>
    </div>
    `);

    let btnGerarPdf = $(`
    <div class="col-md-2 ms-auto d-flex justify-content-end">
        <button class="mt-2 btn btn-phoenix-success btn_gerar_pdf"><span class="far fa-file-pdf me-2"></span>Gerar PDF</button>
    </div>
    `);

    let novaLinha = $('<div class="container_campos_preco_venda_duplicado mb-4"></div>');

    $('.btn_duplica_div').last().hide();
    $('.btn_gerar_pdf').last().hide();

    novaLinha.append(selectsHtml);
    novaLinha.append(camposHtml);
    novaLinha.append(btnGerarPdf);

    $(`.container_duplicar_campos`).append(novaLinha);

    selectsHtml.find(`.btn_exclue_div`).on('click', function () {
        novaLinha.remove();
        $('.btn_duplica_div').last().show();
        $('.btn_gerar_pdf').last().show();
    });

}


$(document).on('change', '#select_cliente', function () {
    let idCliente = $(this).val();

    $.ajax({
        type: 'post',
        url: `${baseUrl}precoVenda/recebeProjetosCliente`,
        data: {
            idCliente: idCliente,
        },
        success: function (response) {
            if (response.success) {
                $('.div_select_projeto_cliente').removeClass('inactive');

                let projetosCliente = '<option value="" selected disabled>Selecione o Projeto</option>';

                $(response.projeto).each(function (index, projeto) {
                    projetosCliente += `<option value="${projeto.codigo_projeto}">${projeto.nome_marca}</option>`;
                });

                $('.select_projetos_cliente').html(projetosCliente);

            } else {
                avisoRetorno(response.title, response.message, response.type, '#');
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status === 403) {
                avisoRetorno('Algo deu errado!', 'Você não tem permissão para esta ação.', 'error', '#');
            }
        }
    });
});


$(document).on('change', '.select_projetos_cliente', function () {

    $(this).closest('.row-selects-preco-venda').find('.div_select_valor_lote').removeClass('inactive');

});


$(document).on('change', '.select_lote_projeto', function () {

    $('#alerta-selecione-campos').fadeOut(1000);

    const loteProjeto = $(this).val();
    const $divLoteCliente = $(this).closest('.div_select_valor_lote');
    const codigoProjeto = $divLoteCliente.siblings('.div_selects_preco_venda').find('.select_projetos_cliente').val();
    const $divCamposPrecoVenda = $(this).closest('.row-selects-preco-venda').siblings('.container_campos_preco_venda');

    $.ajax({
        type: 'post',
        url: `${baseUrl}precoVenda/recebeCustoProjeto`,
        data: {
            codigoProjeto: codigoProjeto,
            loteProjeto: loteProjeto
        },
        success: function (response) {
            if (response.success) {
                // Preencher inputs com informações do banco de dados
                const prefixo = `custo_lote_${loteProjeto}_`;

                $divCamposPrecoVenda.find('.input_ncm').val(response.projeto.codigo_ncm);
                $divCamposPrecoVenda.find('.input_descricao_ncm').val(response.projeto.descricao_ncm);
                $divCamposPrecoVenda.find('.input_custo_produto').val(formatarValorMoeda(response.projeto[`${prefixo}produto`]));
                $divCamposPrecoVenda.find('.input_custo_mao_de_obra').val(formatarValorMoeda(response.projeto[`${prefixo}mao_de_obra`]));
                $divCamposPrecoVenda.find('.input_embalagem').val(formatarValorMoeda(response.projeto[`${prefixo}embalagem`]));
                $divCamposPrecoVenda.find('.input_perda').val(formatarValorMoeda(response.projeto[`${prefixo}perda`]));

                $divCamposPrecoVenda.find('.input_porcentagem_disabled').prop('disabled', false);

                // Funções para atualizar os campos já preenchidos ao trocar de lote
                if ($('.input_margem_porcentagem').val() != '') {
                    atualizarMargem($divCamposPrecoVenda);
                }
                if ($('.input_frete_porcentagem').val() != '') {
                    atualizarFrete($divCamposPrecoVenda);
                }
                if ($('.input_custo_financeiro_porcentagem').val() != '') {
                    atualizarCustoFinanceiro($divCamposPrecoVenda);
                }

                atualizarSubtotal($divCamposPrecoVenda);
                atualizarTotalSemImposto($divCamposPrecoVenda);
                atualizarTotalUnitario($divCamposPrecoVenda);
                atualizarValorTotalSt($divCamposPrecoVenda);

            } else {
                avisoRetorno(response.title, response.message, response.type, '#');
            }
        },
        error: function (xhr) {
            if (xhr.status === 403) {
                avisoRetorno('Algo deu errado!', 'Você não tem permissão para esta ação.', 'error', '#');
            }
        }
    });

});


// Focus out de inputs que passam por funções de cálculos
$(document).on('focusout', '.input_margem_porcentagem', function () {
    let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');

    if ($(this).val() != '') {
        atualizarMargem(containerCamposPrecoVenda);
    } else {
        containerCamposPrecoVenda.find('.input_margem_calculado').val('');
    }

    atualizarSubtotal(containerCamposPrecoVenda);
    atualizarTotalSemImposto(containerCamposPrecoVenda);
    atualizarTotalUnitario(containerCamposPrecoVenda);
    atualizarValorTotalSt(containerCamposPrecoVenda);
});

$(document).on('focusout', '.input_frete_porcentagem', function () {
    let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');

    if ($(this).val() != '') {
        atualizarFrete(containerCamposPrecoVenda);
    } else {
        containerCamposPrecoVenda.find('.input_frete_calculado').val('');
    }

    atualizarSubtotal(containerCamposPrecoVenda);
    atualizarTotalSemImposto(containerCamposPrecoVenda);
    atualizarTotalUnitario(containerCamposPrecoVenda);
    atualizarValorTotalSt(containerCamposPrecoVenda);
});

$(document).on('focusout', '.input_custo_financeiro_porcentagem', function () {
    let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');

    if ($(this).val() != '') {
        atualizarCustoFinanceiro(containerCamposPrecoVenda);
    } else {
        containerCamposPrecoVenda.find('.input_custo_financeiro_calculado').val('');
    }

    atualizarSubtotal(containerCamposPrecoVenda);
    atualizarTotalSemImposto(containerCamposPrecoVenda);
    atualizarTotalUnitario(containerCamposPrecoVenda);
    atualizarValorTotalSt(containerCamposPrecoVenda);
});

$(document).on('focusout', '.input_comissao_porcentagem, .input_imposto_porcentagem', function () {
    let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');

    calculaFator(containerCamposPrecoVenda);

    atualizarTotalUnitario(containerCamposPrecoVenda);
    atualizarComissao(containerCamposPrecoVenda);
    atualizarImposto(containerCamposPrecoVenda);

    let porcentagemStEstado = containerCamposPrecoVenda.find('.input_st_estado_porcentagem').val();
    if (porcentagemStEstado !== '') {
        atualizarStEstado(containerCamposPrecoVenda);
    } else {
        containerCamposPrecoVenda.find('.input_st_estado_calculado').val('');
    }

    atualizarTotalSemImposto(containerCamposPrecoVenda);
    atualizarValorTotalSt(containerCamposPrecoVenda);

    let comissaoPreenchida = containerCamposPrecoVenda.find('.input_comissao_porcentagem').val() !== '';
    let impostoPreenchido = containerCamposPrecoVenda.find('.input_imposto_porcentagem').val() !== '';

    if (!comissaoPreenchida) {
        containerCamposPrecoVenda.find('.input_comissao_calculada').val('');
    }
    if (!impostoPreenchido) {
        containerCamposPrecoVenda.find('.input_imposto_calculado').val('');
    }
});

$(document).on('focusout', '.input_st_estado_porcentagem', function () {
    let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');

    if ($(this).val() != '') {
        atualizarStEstado(containerCamposPrecoVenda);
    } else {
        containerCamposPrecoVenda.find('.input_st_estado_calculado').val('');
    }

    atualizarValorTotalSt(containerCamposPrecoVenda);
});


// Função para converter valores de string para float, tratando diferentes formatações
const converterParaFloat = (valor) => {
    if (valor) {
        let convertido = parseFloat(valor.replace(/[^0-9.,]/g, '').replace(',', '.'));
        return isNaN(convertido) ? 0 : convertido;
    }
    return 0; // Retorna 0 se o valor for undefined, null ou vazio
};

// Funções para atualizar os valores de input com base em cálculos
function atualizarMargem(containerCamposPrecoVenda) {
    let valorTotal = ['.input_custo_produto', '.input_custo_mao_de_obra', '.input_embalagem']
        .map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()))
        .reduce((acc, valor) => acc + valor, 0);

    let porcentagemMargem = converterParaFloat(containerCamposPrecoVenda.find('.input_margem_porcentagem').val());
    let valorPorcentagemMargem = valorTotal * (porcentagemMargem / 100);

    containerCamposPrecoVenda.find('.input_margem_calculado').val(formatarValorMoeda(valorPorcentagemMargem));
}

function atualizarFrete(containerCamposPrecoVenda) {
    let valorTotal = ['.input_custo_produto', '.input_embalagem']
        .map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()))
        .reduce((acc, valor) => acc + valor, 0);

    let porcentagemFrete = converterParaFloat(containerCamposPrecoVenda.find('.input_frete_porcentagem').val());
    let valorPorcentagemFrete = valorTotal * (porcentagemFrete / 100);

    containerCamposPrecoVenda.find('.input_frete_calculado').val(formatarValorMoeda(valorPorcentagemFrete));
}

function atualizarCustoFinanceiro(containerCamposPrecoVenda) {
    let valorTotal = ['.input_custo_produto', '.input_embalagem']
        .map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()))
        .reduce((acc, valor) => acc + valor, 0);

    let porcentagemCusto = converterParaFloat(containerCamposPrecoVenda.find('.input_custo_financeiro_porcentagem').val());
    let valorPorcentagemCusto = valorTotal * (porcentagemCusto / 100);

    containerCamposPrecoVenda.find('.input_custo_financeiro_calculado').val(formatarValorMoeda(valorPorcentagemCusto));
}

function atualizarSubtotal(containerCamposPrecoVenda) {
    const subtotal = [
        '.input_custo_produto', '.input_custo_mao_de_obra', '.input_embalagem', '.input_perda',
        '.input_frete_calculado', '.input_custo_financeiro_calculado', '.input_margem_calculado'
    ]
        .map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()))
        .reduce((acc, valor) => acc + valor, 0);

    containerCamposPrecoVenda.find('.input_sub_total').val(formatarValorMoeda(subtotal));
}

function calculaFator(containerCamposPrecoVenda) {
    let porcentagens = ['.input_comissao_porcentagem', '.input_imposto_porcentagem']
        .map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()))
        .reduce((acc, valor) => acc + valor, 0);

    let fator = porcentagens === 0 ? 1 : (100 - porcentagens) / 100;
    containerCamposPrecoVenda.find('.input_hidden_fator').val(fator.toFixed(2));
}

function atualizarComissao(containerCamposPrecoVenda) {
    let totalUnit = converterParaFloat(containerCamposPrecoVenda.find('.input_total_unitario').val());
    let porcentagemComissao = converterParaFloat(containerCamposPrecoVenda.find('.input_comissao_porcentagem').val());
    let valorPorcentagemComissao = (totalUnit * porcentagemComissao) / 100;

    containerCamposPrecoVenda.find('.input_comissao_calculada').val(formatarValorMoeda(valorPorcentagemComissao));
}

function atualizarTotalSemImposto(containerCamposPrecoVenda) {
    const subtotal = ['.input_sub_total', '.input_comissao_calculada']
        .map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()))
        .reduce((acc, valor) => acc + valor, 0);

    containerCamposPrecoVenda.find('.input_total_sem_imposto').val(formatarValorMoeda(subtotal));
}

function atualizarImposto(containerCamposPrecoVenda) {
    let totalUnit = converterParaFloat(containerCamposPrecoVenda.find('.input_total_unitario').val());
    let porcentagemImposto = converterParaFloat(containerCamposPrecoVenda.find('.input_imposto_porcentagem').val());
    let valorPorcentagemImposto = (totalUnit * porcentagemImposto) / 100;

    containerCamposPrecoVenda.find('.input_imposto_calculado').val(formatarValorMoeda(valorPorcentagemImposto));
}

function atualizarTotalUnitario(containerCamposPrecoVenda) {
    let subtotal = converterParaFloat(containerCamposPrecoVenda.find('.input_sub_total').val());
    let fator = converterParaFloat(containerCamposPrecoVenda.find('.input_hidden_fator').val());
    let novoSubTotal = fator !== 0 ? subtotal / fator : subtotal;

    containerCamposPrecoVenda.find('.input_total_unitario').val(formatarValorMoeda(novoSubTotal));
}

function atualizarStEstado(containerCamposPrecoVenda) {
    let totalUnit = converterParaFloat(containerCamposPrecoVenda.find('.input_total_unitario').val());
    let porcentagemStEstado = converterParaFloat(containerCamposPrecoVenda.find('.input_st_estado_porcentagem').val());
    let valorPorcentagemStEstado = (totalUnit * porcentagemStEstado) / 100;

    containerCamposPrecoVenda.find('.input_st_estado_calculado').val(formatarValorMoeda(valorPorcentagemStEstado));
}

function atualizarValorTotalSt(containerCamposPrecoVenda) {
    let totalUnit = converterParaFloat(containerCamposPrecoVenda.find('.input_total_unitario').val());
    let stEstado = converterParaFloat(containerCamposPrecoVenda.find('.input_st_estado_calculado').val());

    let valorTotalStEstado = totalUnit + stEstado;

    containerCamposPrecoVenda.find('.input_total_st_estado').val(formatarValorMoeda(valorTotalStEstado));
}
