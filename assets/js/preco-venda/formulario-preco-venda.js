var baseUrl = $('.base-url').val();

$(function () {

    $('.input_porcentagem_disabled').prop('disabled', true);

    $('.select2').select2({
        theme: 'bootstrap-5'
    });

});

$('#select_cliente').on('change', function () {

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

$('.select_projetos_cliente').on('change', function () {

    $('.div_select_valor_lote').removeClass('inactive');

});

$('.select_lote_projeto').on('change', function () {

    $('#alerta-selecione-campos').fadeOut(1000);

    $('.input_porcentagem_disabled').prop('disabled', false);

    const $this = $(this);
    const loteProjeto = $this.val();
    const $divLoteCliente = $this.closest('.div_select_valor_lote');
    const codigoProjeto = $divLoteCliente.siblings('.div_selects_preco_venda').find('.select_projetos_cliente').val();
    const $divCamposPrecoVenda = $this.parents().find('.container_campos_preco_venda').first();

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


$('.input_preco_venda_investimento').on('focusout', function () {
    let valorInputInvestimento = $(this).val();

    if (valorInputInvestimento.trim() !== '') {
        let valorFormatado = formatarValorMoeda(valorInputInvestimento);
        $(this).val(valorFormatado);
    }
});

// Focus out de inputs que passam por funções de cálculos
$('.input_margem_porcentagem').on('focusout', function () {

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

$('.input_frete_porcentagem').on('focusout', function () {

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

$('.input_custo_financeiro_porcentagem').on('focusout', function () {

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

$('.input_comissao_porcentagem, .input_imposto_porcentagem').on('focusout', function () {

    let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');

    calculaFator(containerCamposPrecoVenda);

    atualizarTotalUnitario(containerCamposPrecoVenda);
    atualizarComissao(containerCamposPrecoVenda);
    atualizarImposto(containerCamposPrecoVenda);
    atualizarStEstado(containerCamposPrecoVenda);
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

$('.input_st_estado_porcentagem').on('focusout', function () {

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
    let convertido = parseFloat(valor.replace(/[^0-9.,]/g, '').replace(',', '.'));
    return isNaN(convertido) ? 0 : convertido;
};

// Funções para atualizar os valores de input com base em cálculos
function atualizarMargem(containerCamposPrecoVenda) {

    let custoProduto = converterParaFloat(containerCamposPrecoVenda.find('.input_custo_produto').val());
    let custoMo = converterParaFloat(containerCamposPrecoVenda.find('.input_custo_mao_de_obra').val());
    let embalagem = converterParaFloat(containerCamposPrecoVenda.find('.input_embalagem').val());

    let porcentagemMargem = converterParaFloat(containerCamposPrecoVenda.find('.input_margem_porcentagem').val());

    let valorTotal = custoProduto + custoMo + embalagem;
    let valorPorcentagemMargem = valorTotal * (porcentagemMargem / 100);

    containerCamposPrecoVenda.find('.input_margem_calculado').val(formatarValorMoeda(valorPorcentagemMargem));

}

function atualizarFrete(containerCamposPrecoVenda) {

    let custoProduto = converterParaFloat(containerCamposPrecoVenda.find('.input_custo_produto').val());
    let embalagem = converterParaFloat(containerCamposPrecoVenda.find('.input_embalagem').val());

    let porcentagemFrete = converterParaFloat(containerCamposPrecoVenda.find('.input_frete_porcentagem').val());

    let valorTotal = custoProduto + embalagem;
    let valorPorcentagemFrete = valorTotal * (porcentagemFrete / 100);

    containerCamposPrecoVenda.find('.input_frete_calculado').val(formatarValorMoeda(valorPorcentagemFrete));

}

function atualizarCustoFinanceiro(containerCamposPrecoVenda) {

    let custoProduto = converterParaFloat(containerCamposPrecoVenda.find('.input_custo_produto').val());
    let embalagem = converterParaFloat(containerCamposPrecoVenda.find('.input_embalagem').val());

    let porcentagemCusto = converterParaFloat(containerCamposPrecoVenda.find('.input_custo_financeiro_porcentagem').val());

    let valorTotal = custoProduto + embalagem;
    let valorPorcentagemCusto = valorTotal * (porcentagemCusto / 100);

    containerCamposPrecoVenda.find('.input_custo_financeiro_calculado').val(formatarValorMoeda(valorPorcentagemCusto));

}

function atualizarSubtotal(containerCamposPrecoVenda) {

    const valores = [
        '.input_custo_produto',
        '.input_custo_mao_de_obra',
        '.input_embalagem',
        '.input_perda',
        '.input_frete_calculado',
        '.input_custo_financeiro_calculado',
        '.input_margem_calculado'
    ].map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()));

    const subtotal = valores.reduce((acumulado, valor) => acumulado + valor, 0);

    containerCamposPrecoVenda.find('.input_sub_total').val(formatarValorMoeda(subtotal));
}

function calculaFator(containerCamposPrecoVenda) {

    let porcentagemComissao = converterParaFloat(containerCamposPrecoVenda.find('.input_comissao_porcentagem').val());
    let porcentagemImposto = converterParaFloat(containerCamposPrecoVenda.find('.input_imposto_porcentagem').val());

    let fator = (100 - (porcentagemComissao + porcentagemImposto)) / 100;
    let fatorFormatado = fator.toFixed(2);

    containerCamposPrecoVenda.find('.input_hidden_fator').val(fatorFormatado);
}

function atualizarComissao(containerCamposPrecoVenda) {

    let totalUnit = converterParaFloat(containerCamposPrecoVenda.find('.input_total_unitario').val());
    let porcentagemComissao = converterParaFloat(containerCamposPrecoVenda.find('.input_comissao_porcentagem').val());
    let valorPorcentagemComissao = (totalUnit * porcentagemComissao) / 100;

    containerCamposPrecoVenda.find('.input_comissao_calculada').val(formatarValorMoeda(valorPorcentagemComissao));
}

function atualizarTotalSemImposto(containerCamposPrecoVenda) {

    const valores = [
        '.input_sub_total',
        '.input_comissao_calculada'
    ].map(seletor => converterParaFloat(containerCamposPrecoVenda.find(seletor).val()));

    const subtotal = valores.reduce((acumulado, valor) => acumulado + valor, 0);

    containerCamposPrecoVenda.find('.input_total_sem_imposto').val(formatarValorMoeda(subtotal));
}

function atualizarImposto(containerCamposPrecoVenda) {

    let totalUnit = converterParaFloat(containerCamposPrecoVenda.find('.input_total_unitario').val());
    let porcentagemImposto = converterParaFloat(containerCamposPrecoVenda.find('.input_imposto_porcentagem').val());
    let valorPorcentagemImposto = (totalUnit * porcentagemImposto) / 100;

    containerCamposPrecoVenda.find('.input_imposto_calculado').val(formatarValorMoeda(valorPorcentagemImposto));
}

function atualizarTotalUnitario(containerCamposPrecoVenda) {

    const subtotal = converterParaFloat(containerCamposPrecoVenda.find('.input_sub_total').val());
    const fator = converterParaFloat(containerCamposPrecoVenda.find('.input_hidden_fator').val());

    let novoSubTotal = !isNaN(fator) && fator !== 0 ? subtotal / fator : subtotal;

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