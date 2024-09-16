var baseUrl = $('.base-url').val();

$(function () {

    // Máscara e validação do CEP
    $('.input-cep').on('blur', function () {
        let cep = $(this).val().replace(/\D/g, '');

        if (cep.length !== 8 && cep.length > 0) {
            avisoRetorno('CEP inválido', 'Verifique se digitou corretamente!', 'error', '#');
            return;
        }

        preencherEnderecoPorCEP(cep, function (retornoViaCep) {
            if (retornoViaCep.erro) {
                avisoRetorno(retornoViaCep.titulo, retornoViaCep.mensagem, retornoViaCep.type, '#');
                return;
            }

            $('#rua').val(retornoViaCep.logradouro);
            $('#bairro').val(retornoViaCep.bairro);
            $('#cidade').val(retornoViaCep.localidade);
            $('#estado').val(retornoViaCep.uf);
        });
    });

    // Inicialização do select2
    $('.select2').select2({
        theme: "bootstrap-5",
        dropdownParent: $('#modalDesenvolverProjeto')
    });

    $('.select2').select2({
        theme: "bootstrap-5"
    });

    // Atualiza o select de equipamentos com base no nível selecionado
    $('#select-nivel').on('change', function () {
        let nivelSelecionado = $(this).val();

        if (nivelSelecionado) {
            $.ajax({
                url: `${baseUrl}clientes/recebeEquipamentosManipulacaoPorNivel`,
                type: 'POST',
                data: { nivel: nivelSelecionado },
                success: function (resposta) {

                    let opcoesManipulacao = '<option value="" disabled selected>Equipamento Manipulação</option>';

                    $(resposta.manipulacao).each(function (index, manipulacao) {
                        opcoesManipulacao += `<option data-tempo-prod-manipulacao="${manipulacao.tempo_prod}" data-valores-unit-total-manipulacao="${manipulacao.valor_mo}" value="${manipulacao.id}">${manipulacao.nivel} - ${manipulacao.nome}</option>`;
                    });

                    $('#select-equipamentos-manipulacao').html(opcoesManipulacao);

                    $('.campos-custo-manipulacao').find(':input').val('').trigger('change');
                    $('.input-sub-total-2').val('');

                    let opcoesEnvase = '<option value="" disabled selected>Equipamento Envase</option>';
                    $(resposta.envase).each(function (index, envase) {
                        opcoesEnvase += `<option data-pecas-hora-envase="${envase.pcs_hora}" data-valores-unit-total-envase="${envase.valor_mo}" value="${envase.id}">${envase.nivel} - ${envase.nome}</option>`;
                    });

                    $('#select-equipamentos-envase').html(opcoesEnvase);

                    $('.campos-custo-envase-rotulagem').find(':input').val('').trigger('change');
                    $('.input-sub-total-3').val('');

                },
                error: function (xhr, status, error) {
                    console.log('Erro ao carregar equipamentos:', error);
                }
            });
        } else {
            $('#select-equipamentos-manipulacao').html('<option value="" disabled selected>Selecione o equipamento</option>');
        }
    });


    $('#select-equipamentos-manipulacao').on('change', function () {

        let tempoProd = $(this).find('option:selected').data('tempo-prod-manipulacao');

        let valoresUnitTotal = $(this).find('option:selected').data('valores-unit-total-manipulacao');

        $('.modal-desenvolver-custo-manipulacao-tempo').val(tempoProd);

        if (valoresUnitTotal) {
            $('.modal-desenvolver-custo-manipulacao-valor-unit').val(formatarValorMoeda(valoresUnitTotal));
        }

    });

    $('#select-equipamentos-envase').on('change', function () {
        let pcsHora = $(this).find('option:selected').data('pecas-hora-envase');
        let valoresUnitTotal = $(this).find('option:selected').data('valores-unit-total-envase');

        $('.modal-desenvolver-custo-envase-pecas-hora').val(pcsHora);

        if (valoresUnitTotal) {
            $('.modal-desenvolver-custo-envase-valor-unit').val(formatarValorMoeda(valoresUnitTotal));
        }

        // Calcular o sub-total após o valor de envase ser alterado
        calcularSubTotal3();
    });

    // Evento change para o select2 de rotulagem
    $('#select-equipamentos-rotulagem').on('change', function () {
        let pcsHora = $(this).find('option:selected').data('pecas-hora-rotulagem');
        let valoresUnitTotal = $(this).find('option:selected').data('valores-unit-total-rotulagem');

        $('.modal-desenvolver-custo-rotulagem-pecas-hora').val(pcsHora);

        if (valoresUnitTotal) {
            $('.modal-desenvolver-custo-rotulagem-valor-unit').val(formatarValorMoeda(valoresUnitTotal));
        }

        // Calcular o sub-total após o valor de rotulagem ser alterado
        calcularSubTotal3();
    });

});

$(document).on('focusout', '.modal-desenvolver-input-percentual', function () {

    let divPercentual = $(this).closest('.div-percentual');

    let valorQuantidade = divPercentual.find('input').val() / 100;

    divPercentual.siblings('.div-quantidade').find('input').val(valorQuantidade.toFixed(3).replace('.', ','))

    let valorMateriaPrima = divPercentual.siblings('.div-valor-materia-prima').find('input').val();

    let valorMateriaPrimaFormatado = valorMateriaPrima.replace(',', '.').replace('R$', '');

    calculaTotalLinha(valorMateriaPrimaFormatado, valorQuantidade, divPercentual);

    calculaPorcentagemTotal();

});


$(document).on('change', '.modal-desenvolver-select-materia-prima', function () {

    let divMateriaPrima = $(this).closest('.div-materia-prima');

    let valorMateriaPrima = $(this).find('option:selected').data('valor-materia-prima');

    valorMateriaPrima = parseFloat(valorMateriaPrima) || 0;

    let valorFormatado = formatarValorMoeda(valorMateriaPrima);

    divMateriaPrima.siblings('.div-valor-materia-prima').find('input').val(valorFormatado);

    let quantidadeMateriaPrima = divMateriaPrima.siblings('.div-quantidade').find('input').val().replace(',', '.');

    quantidadeMateriaPrima = parseFloat(quantidadeMateriaPrima) || 0;

    calculaTotalLinha(valorMateriaPrima, quantidadeMateriaPrima, divMateriaPrima);
});

function calculaTotalLinha(valorMateriaPrima, quantidadeMateriaPrima, divMateriaPrima) {
    let valorTotalLinha = valorMateriaPrima * quantidadeMateriaPrima;

    divMateriaPrima.siblings('.div-total-linha').find('input').val('R$' + valorTotalLinha.toFixed(3).replace('.', ','));

    calculaSubTotal1();
}

$(document).on('input', '.modal-desenvolver-input-percentual', function () {
    let valor = $(this).val().replace(',', '.');

    // Limita o valor máximo a 100 e o número máximo de dígitos a 3
    if (parseFloat(valor) > 100) {
        $(this).val('100');
    } else if (valor.length > 5) {
        $(this).val(valor.substring(0, 5));
    }

    // Atualiza o total de porcentagem sempre que o valor é alterado
    calculaPorcentagemTotal();
});

$(document).on('blur', '.modal-desenvolver-input-percentual', function () {
    let valor = $(this).val().replace(',', '.');

    // Remove pontos e vírgulas extras no final
    if (valor.includes('.')) {
        valor = valor.replace(/(\.\d{2})\d+/, '$1');
    }

    $(this).val(valor);
});

function calculaPorcentagemTotal() {
    let valorTotal = 0;

    $('.modal-desenvolver-input-porcentagem').each(function () {
        let valorPorcentagem = parseFloat($(this).val()) || 0;
        valorTotal += valorPorcentagem;
    });

    if (valorTotal > 100) {
        Swal.fire({
            title: 'Atenção!',
            text: 'A soma das porcentagens não pode exceder 100%.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        });

        valorTotal = 100;
    }

    $('.input-porcentagem-total').val(valorTotal.toFixed(2).replace('.', ','));
}


function calculaSubTotal1() {
    let valorSubTotal = 0;

    $('.modal-desenvolver-input-total-materia-prima').each(function () {
        // Remove o prefixo 'R$' e substitui a vírgula por ponto para a conversão para número
        let valorTotal = $(this).val().replace('R$', '').replace('.', '').replace(',', '.');
        valorSubTotal += parseFloat(valorTotal) || 0;
    });

    // Atualiza o campo de Sub-Total
    $('.input-sub-total').val('R$' + valorSubTotal.toFixed(3).replace('.', ','));
}

function calcularSubTotal3() {
    // Obter os valores dos campos de total de envase e rotulagem
    let totalEnvase = parseFloat($('.modal-desenvolver-custo-envase-valor-unit').val().replace('R$', '').replace(',', '.')) || 0;
    let totalRotulagem = parseFloat($('.modal-desenvolver-custo-rotulagem-valor-unit').val().replace('R$', '').replace(',', '.')) || 0;

    // Calcular o sub-total somando os valores de envase e rotulagem
    let subTotal3 = totalEnvase + totalRotulagem;

    // Exibir o resultado formatado no campo sub-total-3
    $('.input-sub-total-3').val(formatarValorMoeda(subTotal3));
}

function calcularSubTotal4() {

    const elementos = [
        '.modal-desenvolver-custo-rotulo',
        '.modal-desenvolver-custo-frasco',
        '.modal-desenvolver-custo-tampa',
        '.modal-desenvolver-custo-display',
        '.modal-desenvolver-custo-caixa-embarque'
    ];

    let subtotal = 0;

    elementos.forEach(function (seletor) {
        let valor = parseFloat($(seletor).val().replace('R$', '').replace(',', '.')) || 0;
        subtotal += valor;
    });

    $('.input-sub-total-4').val(formatarValorMoeda(subtotal));
}

function calcularTotalProjeto() {

    const valores = [
        '.input-custo-final-produto',
        '.input-custo-final-manipulacao',
        '.input-custo-final-envase',
        '.input-custo-final-rotulagem',
        '.input-custo-final-outros',
        '.input-custo-final-perda'
    ];

    valores.forEach(function (inputs) {
        let valorInput = parseFloat($(inputs).replace('R$', '').replace(',', '.')) || 0;
        totalFinal += valorInput;
    });

    $('.input-total-projeto').val(formatarValorMoeda(totalFinal));
}



$(document).on('click', '.btn-duplica-linha', function () {
    duplicarLinhas();
    carregaSelect2('select2', 'modalDesenvolverProjeto');
});


function duplicarLinhas() {

    let optionsMateriaPrima = $('.modal-desenvolver-select-materia-prima').html();

    let selectMateriaPrima = `
        <div class="col-md-3 div-materia-prima">
            <select class="form-control campo-briefing select2 modal-desenvolver-select-materia-prima" name="select-materia-prima">
                ${optionsMateriaPrima}
            </select>
            <div class="d-none aviso-obrigatorio">Preencha este campo</div>
        </div>
    `;

    let percentual = `
        <div class="col-md-2 div-percentual">
            <div class="input-group">
                <input type="number" class="form-control modal-desenvolver-input-percentual modal-desenvolver-input-percentual-duplicado">
                <span class="input-group-text">%</span>
            </div>
         </div>
    `;

    let quantidade = `
        <div class="col-md-2 div-quantidade">
            <div class="input-group">
                <input type="text" class="mascara-peso form-control modal-desenvolver-input-quantidade-materia-prima">
                <span class="input-group-text">kg</span>
            </div>
        </div>
    `;

    let valorMp = `
        <div class="col-md-2 div-valor-materia-prima">
            <input disabled type="text" class="text-1000 form-control modal-desenvolver-input-valor-materia-prima">
        </div>
    `;

    let totalLinha = `
        <div class="col-md-2 div-total-linha">
            <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-input-total-materia-prima">
        </div>
    `;

    let btnRemove = $(`
        <div class="col-md-1 add-botao-mais p-0">
            <button class="btn btn-phoenix-danger remover-linhas" style="padding: 14px;margin: 0; padding-top: 8px;
            padding-bottom: 8px;">-</button>
            <button title="Mais custos" type="button" class="btn btn-phoenix-success btn-duplica-linha" style="padding: 14px;margin: 0; padding-top: 8px;
            padding-bottom: 8px;">+</button>
        </div>`);

    let novaLinha = $('<div class="row mb-2"></div>');

    // remove o botão + da linha atual
    $('.btn-duplica-linha').last().hide();

    novaLinha.append(selectMateriaPrima);
    novaLinha.append(percentual);
    novaLinha.append(quantidade);
    novaLinha.append(valorMp);
    novaLinha.append(totalLinha);
    novaLinha.append(btnRemove);

    $(`.campos-duplicados`).append(novaLinha);

    // Remove a linha duplicada
    btnRemove.find(`.remover-linhas`).on('click', function () {
        novaLinha.remove();
        calculaSubTotal1();
        // Reaparece o botão + na última linha existente
        $('.btn-duplica-linha').last().show();
    });

}

const cadastraProjeto = () => {

    alert('OI')

    let id = $('.input-id').val();

    let dadosInformacoes = {};
    $('#form-informacoes .campo-informacoes').each(function () {
        // Trata os checkboxes como 0 ou 1
        if ($(this).attr('type') == 'checkbox') {
            dadosInformacoes[$(this).attr('name')] = $(this).is(':checked') ? 1 : 0;
        } else {
            dadosInformacoes[$(this).attr('name')] = $(this).val();
        }
    });

    let dadosBriefing = {};
    $('#form-briefing .campo-briefing').each(function () {
        dadosBriefing[$(this).attr('name')] = $(this).val();
    });

    let dadosCustos = {};
    $('#form-custos .campo-custos').each(function () {
        dadosCustos[$(this).attr('name')] = $(this).val();
    });

    let idCliente = $('.input-id-cliente').val();

    $.ajax({
        type: 'POST',
        url: `${baseUrl}projetos/cadastraProjeto`,
        data: {
            dadosInformacoes: dadosInformacoes,
            dadosBriefing: dadosBriefing,
            dadosCustos: dadosCustos,
            id: id,
            idCliente: idCliente
        },
        beforeSend: function () {
            $('.load-form').removeClass('d-none');
            $('.bnt-voltar').addClass('d-none');
            $('.btn-proximo').addClass('d-none');
        },
        success: function (data) {

            if (data.success) {

                avisoRetorno('Sucesso!', `${data.message}`, 'success', `${baseUrl}/clientes/detalhes/${data.idClienteCadastrado}`);

            } else {

                avisoRetorno('Algo deu errado!', `${data.message}`, 'error', '#');

            }

        }
    });
}


const inativaProjetoCliente = (id, idCliente) => {

    Swal.fire({
        title: 'Você tem certeza?',
        text: "O Cliente será inativado mas seu projeto continuará salvo.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, inativar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'post',
                url: `${baseUrl}projetos/inativaProjetoCliente`,
                data: {
                    id: id
                },
                success: function (data) {
                    let redirect = data.type != 'error' ? `${baseUrl}clientes/detalhes/${idCliente}` : '#';

                    avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, `${redirect}`);
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 403) {
                        avisoRetorno('Algo deu errado!', `Você não tem permissão para esta ação..`, 'error', '#');
                    }
                }
            });
        }
    });
}

const ativarProjetoCliente = (id, idCliente) => {

    Swal.fire({
        title: 'Você tem certeza?',
        text: "O projeto será reativado para este cliente.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, reativar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'post',
                url: `${baseUrl}projetos/ativarProjetoCliente`,
                data: {
                    id: id
                },
                success: function (data) {
                    let redirect = data.type != 'error' ? `${baseUrl}clientes/detalhes/${idCliente}` : '#';

                    avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, `${redirect}`);
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 403) {
                        avisoRetorno('Algo deu errado!', `Você não tem permissão para esta ação..`, 'error', '#');
                    }
                }
            });
        }
    });
}

$(document).on('change', '#select_projeto_cliente', function () {

    $('#modalDesenvolverProjetoTitulo').html($(this).find('option:selected').text());

    let codigoProjeto = $(this).val();

    if ($(this).val() != '') {
        $.ajax({
            type: 'post',
            url: `${baseUrl}projetos/recebeProjetoClienteCodigo`,
            data: {
                codigoProjeto: codigoProjeto
            },
            success: function (response) {

                $('.campos-duplicados').html('');
                $('.btn-duplica-linha').show();

                if (response.success) {

                    console.log(response.data[0].custo_sub_total_1)

                    let dataFormatada = response.data[0].criado_em.split(' ');

                    if (response.data.length < 2) {
                        avisoRetorno('Atenção!', 'Nenhuma Matéria Prima Atrelada ao Projeto', 'error', '#')
                        $('.modal-desenvolver-select-materia-prima').val('').trigger('change');
                    }

                    // Atualiza os campos do modal com as informações do projeto
                    $('.modal-desenvolver-input-data').val(formatarDatas(dataFormatada[0]));
                    $('.modal-desenvolver-input-nome-produto').val(response.data[0].nome_produto);
                    $('.modal-desenvolver-input-nome-cliente').val(response.data[0].CLIENTE_NOME_FANTASIA);
                    $('.modal-desenvolver-input-quantidade').val(response.data[0].quantidade_geral_projeto);
                    $('.modal-desenvolver-input-nivel-produto').val(response.data[0].nivel_produto);

                    // Matérias Primas
                    let numSelects = response.data.length - 1;
                    let selectsCriados = $('.modal-desenvolver-select-materia-prima').length;

                    if (selectsCriados < numSelects) {
                        for (let i = selectsCriados; i < numSelects; i++) {
                            $('.btn-duplica-linha').last().trigger('click');
                        }

                        setTimeout(() => {
                            $.each(response.data.slice(1), (selectIndex, materiaPrima) => {
                                setTimeout(() => {
                                    $('.modal-desenvolver-select-materia-prima').eq(selectIndex).val(materiaPrima.id).trigger('change');
                                    $('.modal-desenvolver-input-percentual').eq(selectIndex).val(formatarPercentual(materiaPrima.PERCENTUAL_MP_PROJETO));
                                    $('.modal-desenvolver-input-quantidade-materia-prima').eq(selectIndex).val(materiaPrima.QUANTIDADE_MP_PROJETO);
                                    $('.modal-desenvolver-input-valor-materia-prima').eq(selectIndex).val(materiaPrima.VALOR_MP_PROJETO);
                                    $('.modal-desenvolver-input-total-materia-prima').eq(selectIndex).val(materiaPrima.TOTAL_MP_PROJETO);
                                }, 100);
                            });
                        }, 500);
                    }

                    $.each(response.data.slice(1), (selectIndex, materiaPrima) => {
                        $('.modal-desenvolver-select-materia-prima').eq(selectIndex).val(materiaPrima.id).trigger('change');
                        $('.modal-desenvolver-input-percentual').eq(selectIndex).val(formatarPercentual(materiaPrima.PERCENTUAL_MP_PROJETO));
                        $('.modal-desenvolver-input-quantidade-materia-prima').eq(selectIndex).val(materiaPrima.QUANTIDADE_MP_PROJETO);
                        $('.modal-desenvolver-input-valor-materia-prima').eq(selectIndex).val(materiaPrima.VALOR_MP_PROJETO);
                        $('.modal-desenvolver-input-total-materia-prima').eq(selectIndex).val(materiaPrima.TOTAL_MP_PROJETO);

                    });

                    $('.input-sub-total').val(formatarValorMoeda(response.data[0].custo_sub_total_1));


                } else {

                    avisoRetorno(response.title, response.message, response.type, '#');
                }
            }
        });
    }

});

const desenvolverProjeto = () => {

    let dataAtual = new Date();
    let dataAtualFormatada = dataAtual.toLocaleDateString('pt-BR');

    $('.modal-desenvolver-input-data').val(dataAtualFormatada);

    $('#modalDesenvolverProjeto').find('input[type="text"], input[type="number"], input[type="email"], input[type="password"], textarea').val('');

    $('#modalDesenvolverProjeto').find('.select2').each(function () {
        $(this).val(null).trigger('change');
    });

    $('#modalDesenvolverProjeto').find('form').each(function () {
        this.reset();
    });
}

function formatarPercentual(valor) {
    // Converte o valor para número
    let numero = parseFloat(valor);

    // Formata o número para ter uma casa decimal se necessário
    if (numero % 1 === 0) {
        // Se não houver parte decimal, retorna como inteiro
        return numero.toString();
    } else {
        // Se houver parte decimal, retorna com uma casa decimal
        return numero.toFixed(1).replace(/\.0$/, '');
    }
}


