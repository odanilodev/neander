var baseUrl = $('.base-url').val();

$(function () {

    $('.input_porcentagem_disabled').prop('disabled', true);

    $('.select2').select2({
        theme: 'bootstrap-5'
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

    // $('.select_lote_projeto').on('change', function () {

    //     let divCamposPrecoVenda = $(this).parents().find('.container_campos_preco_venda').first();

    //     let loteProjeto = $(this).val();

    //     let divLoteCliente = $(this).closest('.div_select_valor_lote');
    //     let codigoProjeto = divLoteCliente.siblings('.div_selects_preco_venda').find('.select_projetos_cliente').val();

    //     $.ajax({
    //         type: 'post',
    //         url: `${baseUrl}precoVenda/recebeCustoProjeto`,
    //         data: {
    //             codigoProjeto: codigoProjeto,
    //             loteProjeto: loteProjeto
    //         },
    //         success: function (response) {

    //             if (response.success) {
    //                 let prefixo = `custo_lote_${loteProjeto}_`;

    //                 divCamposPrecoVenda.find('.input_custo_produto').val(formatarValorMoeda(response.projeto[`${prefixo}produto`]));
    //                 divCamposPrecoVenda.find('.input_custo_mao_de_obra').val(formatarValorMoeda(response.projeto[`${prefixo}mao_de_obra`]));
    //                 divCamposPrecoVenda.find('.embalagem').val(formatarValorMoeda(response.projeto[`${prefixo}embalagem`]));
    //                 divCamposPrecoVenda.find('.perda').val(formatarValorMoeda(response.projeto[`${prefixo}perda`]));

    //             } else {
    //                 avisoRetorno(response.title, response.message, response.type, '#');
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             if (xhr.status === 403) {
    //                 avisoRetorno('Algo deu errado!', 'Você não tem permissão para esta ação.', 'error', '#');
    //             }
    //         }
    //     });
    // });

    $('.select_lote_projeto').on('change', function () {

        $('#alerta-selecione-campos').fadeOut(900);

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

    // Focus out de inputs que passam por funções de calculos
    $('.input_margem_porcentagem').on('focusout', function () {
        if ($(this).val() != '') {
            let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');
            atualizarMargem(containerCamposPrecoVenda);
        }
    });

    $('.input_frete_porcentagem').on('focusout', function () {
        if ($(this).val() != '') {
            let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');
            atualizarFrete(containerCamposPrecoVenda);
        }
    });

    $('.input_custo_financeiro_porcentagem').on('focusout', function () {
        if ($(this).val() != '') {
            let containerCamposPrecoVenda = $(this).closest('.container_campos_preco_venda');
            atualizarCustoFinanceiro(containerCamposPrecoVenda);
        }
    });

    // Funções para atualizar valores de inputs com calculos
    function atualizarMargem(containerCamposPrecoVenda) {
        let custoProduto = parseFloat(containerCamposPrecoVenda.find('.input_custo_produto').val().replace(/[^0-9.,]/g, '').replace(',', '.'));
        let custoMo = parseFloat(containerCamposPrecoVenda.find('.input_custo_mao_de_obra').val().replace(/[^0-9.,]/g, '').replace(',', '.'));
        let embalagem = parseFloat(containerCamposPrecoVenda.find('.input_embalagem').val().replace(/[^0-9.,]/g, '').replace(',', '.'));

        let porcentagemMargem = parseFloat(containerCamposPrecoVenda.find('.input_margem_porcentagem').val());

        let valorTotal = custoProduto + custoMo + embalagem;
        let valorPorcentagem = valorTotal * (porcentagemMargem / 100);

        containerCamposPrecoVenda.find('.input_margem_reais').val(formatarValorMoeda(valorPorcentagem));
    }

    function atualizarFrete(containerCamposPrecoVenda) {

        let custoProduto = parseFloat(containerCamposPrecoVenda.find('.input_custo_produto').val().replace(/[^0-9.,]/g, '').replace(',', '.'));
        let embalagem = parseFloat(containerCamposPrecoVenda.find('.input_embalagem').val().replace(/[^0-9.,]/g, '').replace(',', '.'));

        let porcentagemFrete = parseFloat(containerCamposPrecoVenda.find('.input_frete_porcentagem').val());

        let valorTotal = custoProduto + embalagem;
        let valorPorcentagem = valorTotal * (porcentagemFrete / 100);

        containerCamposPrecoVenda.find('.input_frete_calculado').val(formatarValorMoeda(valorPorcentagem));
    }

    function atualizarCustoFinanceiro(containerCamposPrecoVenda) {

        let custoProduto = parseFloat(containerCamposPrecoVenda.find('.input_custo_produto').val().replace(/[^0-9.,]/g, '').replace(',', '.'));
        let embalagem = parseFloat(containerCamposPrecoVenda.find('.input_embalagem').val().replace(/[^0-9.,]/g, '').replace(',', '.'));

        let porcentagemCusto = parseFloat(containerCamposPrecoVenda.find('.input_custo_financeiro_porcentagem').val());

        let valorTotal = custoProduto + embalagem;
        let valorPorcentagem = valorTotal * (porcentagemCusto / 100);

        containerCamposPrecoVenda.find('.input_custo_financeiro_calculado').val(formatarValorMoeda(valorPorcentagem));
    }


});

function limparCamposInvestimento() {
    $('.input_preco_venda_investimento').each(function () {
        $(this).val('');
    });
}