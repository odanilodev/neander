var baseUrl = $('.base-url').val();

$(function () {
    $('.select2').select2({
        dropdownParent: $('#modalDesenvolverProjeto'),
        theme: 'bootstrap-5',
    });
});

const modalDesenvolverProjeto = () => {
    $('#select_projeto_cliente').val(null).trigger('change');

    $('#alerta-selecione-campos').fadeIn(1000);
    $('.container-modal-desenvolver-projeto').addClass('d-none');

    $('.modal-body-desenvolver-projeto').find(':input').val('');

    $('.select2').select2({
        dropdownParent: $('#modalDesenvolverProjeto'),
        theme: 'bootstrap-5',
    });

};

// $('.card-body').find(':input').prop('disabled', true);
// $('#select_projeto_cliente').prop('disabled', false);

// $('#modalDesenvolverProjeto').find('input[type="text"], input[type="number"], input[type="email"], input[type="password"], textarea').val('');

// $('#modalDesenvolverProjeto').find('.select2').each(function () {
//     $(this).val(null).trigger('change');
// });
// $('#modalDesenvolverProjeto').find('form').each(function () {
//     this.reset();
// });

// let dataAtual = new Date();
// let dataAtualFormatada = dataAtual.toLocaleDateString('pt-BR');

// $('.modal-desenvolver-input-data').val(dataAtualFormatada);
//Desenvolver Projeto - Select Projeto
//=========================================
$(document).on('change', '#select_projeto_cliente', function () {

    $('#modalDesenvolverProjetoTitulo').html($(this).find('option:selected').text());

    let hoje = new Date().toISOString().split('T')[0];
    $('.modal-desenvolver-input-data').val(formatarDatas(hoje));
    $('.modal-desenvolver-input-producao').val('1,000 g');

    let nomeProduto = $(this).find('option:selected').data('nome-produto');
    let nomeFantasia = $(this).find('option:selected').data('nome-fantasia');

    $('.modal-desenvolver-input-nome-produto').val(nomeProduto);
    $('.modal-desenvolver-input-nome-cliente').val(nomeFantasia);

    $('.container-modal-desenvolver-projeto').removeClass('d-none');

    if ($(this).val()) {
        $('#alerta-selecione-campos').fadeOut(1000);
    }

});
//=========================================

// Matérias Primas
//=========================================
$(document).on('change', '.modal-desenvolver-select-materia-prima', function () {
    const divMateriaPrima = $(this).closest('.div-materia-prima');
    const valorMateriaPrima = parseFloat(divMateriaPrima.find('.modal-desenvolver-select-materia-prima option:selected').data('valor-materia-prima')) || 0;

    atualizarTotalLinha(divMateriaPrima, valorMateriaPrima);
    calcularPorcentagemESubtotal(divMateriaPrima);
});

function atualizarTotalLinha(divMateriaPrima, valorMateriaPrima) {
    const totalInput = divMateriaPrima.siblings('.div-total-linha').find('input');
    totalInput.val(formatarValorMoeda(valorMateriaPrima));

    const quantidade = parseFloat(divMateriaPrima.siblings('.div-quantidade').find('input').val().replace(',', '.')) || 0;
    calculaTotalLinha(valorMateriaPrima, quantidade, divMateriaPrima);
}

function calcularPorcentagemESubtotal(divMateriaPrima) {
    calculaPorcentagemTotal();
    calculaSubTotal1();
}



$(document).on('focusout', '.modal-desenvolver-input-percentual', function () {
    let divPercentual = $(this).closest('.div-percentual');
    let valorPercentual = divPercentual.find('input').val() / 100;

    divPercentual.siblings('.div-quantidade').find('input').val(valorPercentual.toFixed(3).replace('.', ','));

    let divMateriaPrima = divPercentual.closest('.row').find('.div-materia-prima');
    let valorMateriaPrima = parseFloat(divMateriaPrima.find('.modal-desenvolver-select-materia-prima option:selected').data('valor-materia-prima')) || 0;

    calculaTotalLinha(valorMateriaPrima, valorPercentual, divMateriaPrima);
    calculaPorcentagemTotal();
});

function calculaTotalLinha(valorMateriaPrima, quantidadeMateriaPrima, divMateriaPrima) {
    const valorTotalLinha = valorMateriaPrima * quantidadeMateriaPrima;
    divMateriaPrima.siblings('.div-total-linha').find('input').val('R$' + valorTotalLinha.toFixed(3).replace('.', ','));
    calculaSubTotal1();
}

$(document).on('input', '.modal-desenvolver-input-percentual', function () {
    let valor = $(this).val().replace(',', '.');

    // Limita o valor máximo a 200
    if (parseFloat(valor) > 200) {
        $(this).val('200');
    } else if (valor.length > 5) {
        $(this).val(valor.substring(0, 5));
    }

    // Atualiza o total de porcentagem sempre que o valor é alterado
    calculaPorcentagemTotal();
});

$(document).on('blur', '.modal-desenvolver-input-percentual', function () {
    let valor = $(this).val().replace(',', '.');
    if (valor.includes('.')) {
        valor = valor.replace(/(\.\d{2})\d+/, '$1');
    }
    $(this).val(valor);
});

function calculaPorcentagemTotal() {
    let valorTotal = 0;
    $('.modal-desenvolver-input-percentual').each(function () {
        valorTotal += parseFloat($(this).val()) || 0;
    });

    // Exibe o aviso se a porcentagem total ultrapassar 100%
    if (valorTotal > 100) {
        $('.aviso-obrigatorio').removeClass('d-none')
        $('.input-porcentagem-total').addClass('invalido')
    } else {
        $('.aviso-obrigatorio').addClass('d-none')
        $('.input-porcentagem-total').removeClass('invalido')
    }

    $('.input-porcentagem-total').val(valorTotal.toFixed(2).replace('.', ','));
}

function calculaSubTotal1() {
    let valorSubTotal = 0;
    $('.modal-desenvolver-input-total-materia-prima').each(function () {
        let valorTotal = $(this).val().replace('R$', '').replace('.', '').replace(',', '.');
        valorSubTotal += parseFloat(valorTotal) || 0;
    });

    $('.input-sub-total').val('R$' + valorSubTotal.toFixed(3).replace('.', ','));
}

$(document).on('click', '.btn-duplica-linha', function () {
    duplicarLinhas();
    carregaSelect2('select2', 'modalDesenvolverProjeto');
});

function duplicarLinhas() {
    let optionsMateriaPrima = $('.modal-desenvolver-select-materia-prima').html();

    let novaLinha = $(`
        <div class="row mb-2">
            <div class="col-md-4 div-materia-prima">
                <select class="form-control campo-briefing select2 modal-desenvolver-select-materia-prima" name="select-materia-prima">
                    ${optionsMateriaPrima}
                </select>
            </div>
            <div class="col-md-1 mb-2 div-fase">
                <input type="text" class="form-control modal-desenvolver-input-fase">
            </div>
            <div class="col-md-2 div-percentual">
                <div class="input-group">
                    <input type="number" class="form-control modal-desenvolver-input-percentual">
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <div class="col-md-2 div-quantidade">
                <div class="input-group">
                    <input type="text" disabled class="text-1000 mascara-peso form-control modal-desenvolver-input-quantidade-materia-prima">
                    <span class="input-group-text">KG.</span>
                </div>
            </div>
            <div class="col-md-2 div-total-linha">
                <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-input-total-materia-prima">
            </div>
            <div class="col-md-1 add-botao-mais p-0">
                <button class="btn btn-phoenix-danger remover-linhas px-3" style="padding: 10px; margin-bottom: 5px;">-</button>
                <button class="btn btn-phoenix-success btn-duplica-linha px-3" style="padding: 10px; margin-bottom: 5px;">+</button>
            </div>
        </div>
    `);

    // Remove o botão + da linha atual
    $('.btn-duplica-linha').last().hide();

    $('.campos-duplicados').append(novaLinha);

    // Remove a linha duplicada
    novaLinha.find('.remover-linhas').on('click', function () {
        novaLinha.remove();
        calculaSubTotal1();
        $('.btn-duplica-linha').last().show();
    });
}

$(document).on('input', '.modal-desenvolver-input-quantidade-materia-prima', function () {
    let divMateriaPrima = $(this).closest('.div-materia-prima');
    let percentualInput = divMateriaPrima.siblings('.div-percentual').find('.modal-desenvolver-input-percentual');
    let quantidade = parseFloat($(this).val()) || 0;
    let percentual = quantidade * 100; // Converte para percentual

    percentualInput.val(percentual.toFixed(2).replace('.', ','));
    let valorMateriaPrima = parseFloat(divMateriaPrima.find('.modal-desenvolver-select-materia-prima option:selected').data('valor-materia-prima')) || 0;

    // Atualiza o total da linha
    calculaTotalLinha(valorMateriaPrima, quantidade, divMateriaPrima);
});

$(document).on('change', '.select-principal-materia-prima', function () {
    $('.modal-desenvolver-input-percentual-principal').val(100);
    $('.modal-desenvolver-input-percentual-principal').trigger('focusout');
});

//=========================================

// Manipulação

const calculaTotalManipulacao = () => {
    let custoHoraManipulacao = $('#select-equipamentos-manipulacao option:selected').data('custo-hora');
    let tempoManipulacao = $('.modal-desenvolver-custo-manipulacao-tempo').val();

    let partes = tempoManipulacao.split(':');
    let horas = parseFloat(partes[0]) + parseFloat(partes[1]) / 60 + parseFloat(partes[2]) / 3600;

    let total = horas * custoHoraManipulacao;

    $('.modal-desenvolver-custo-manipulacao-valor-unit').val(formatarValorMoeda(total))
}

$('.modal-desenvolver-custo-manipulacao-tempo').on('focusout', function () {
    calculaTotalManipulacao();
});

$('.input-quantidade-manipulacao').on('focusout', function () {

    let quantidadeManipulacao = $(this).val();
    let quantidadeGeral = $('.modal-desenvolver-input-quantidade').val();

    quantidadeManipulacao = parseFloat(quantidadeManipulacao.replace(',', '.'));
    quantidadeGeral = parseFloat(quantidadeGeral.replace(',', '.'));

    let quantidadePecasHora = parseFloat(quantidadeManipulacao) / parseFloat(quantidadeGeral);

    $('.input-quantidade-envase').val(quantidadePecasHora);
    $('.input-quantidade-rotulagem').val(quantidadePecasHora);


});

//=========================================
const editarProjetoDesenvolvido = () => {

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

                    let dataFormatada = response.data[0].criado_em.split(' ');

                    if (response.data.length < 2) {
                        $('.modal-desenvolver-select-materia-prima').val('').trigger('change');
                    }

                    // Atualiza os campos do modal com as informações do projeto
                    $('.modal-desenvolver-input-data').val(formatarDatas(dataFormatada[0]));
                    $('.modal-desenvolver-input-producao').val('1,000 g');
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
}

$('#select-equipamentos-envase').on('change', function () {

    let idEquipamento = $(this).val();

    $.ajax({
        type: 'post',
        url: `${baseUrl}equipamentosEnvase/recebeDadosEquipamentoEnvase`,
        data: {
            idEquipamento: idEquipamento
        },
        success: function (response) {

            if (response.success) {

                let pcsHoraEnvase = response.equipamento.pcs_hora;
                $('.modal-desenvolver-custo-envase-pecas-hora').val(pcsHoraEnvase);


            } else {

                avisoRetorno(response.title, response.message, response.type, '#');
            }
        }
    });

    let quantidade = $('.input-quantidade-envase').val();
    // let pcsHora = $(this).find('option:selected').data('pecas-hora-envase');
    let valoresUnitTotal = $(this).find('option:selected').data('valores-unit-total-envase');
    let valorTotal = quantidade * valoresUnitTotal;

    // $('.modal-desenvolver-custo-envase-pecas-hora').val(pcsHora);

    if (valoresUnitTotal) {
        $('.modal-desenvolver-custo-envase-valor-unit').val(formatarValorMoeda(valoresUnitTotal));
        $('.modal-desenvolver-custo-envase-valor-total').val(formatarValorMoeda(valorTotal))
    }

    // Calcular o sub-total após o valor de envase ser alterado
    calcularSubTotal3();
});
// Evento change para o select2 de rotulagem
$('#select-equipamentos-rotulagem').on('change', function () {

    let idEquipamento = $(this).val();

    $.ajax({
        type: 'post',
        url: `${baseUrl}equipamentosRotulagem/recebeDadosEquipamentoRotulagem`,
        data: {
            idEquipamento: idEquipamento
        },
        success: function (response) {

            if (response.success) {

                let pcsHoraRotulagem = response.equipamento.pcs_hora;
                $('.modal-desenvolver-custo-rotulagem-pecas-hora').val(pcsHoraRotulagem);


            } else {

                avisoRetorno(response.title, response.message, response.type, '#');
            }
        }
    });

    // let pcsHora = $(this).find('option:selected').data('pecas-hora-rotulagem');
    let valoresUnitTotal = $(this).find('option:selected').data('valores-unit-total-rotulagem');

    $('.modal-desenvolver-custo-rotulagem-pecas-hora').val(pcsHora);

    if (valoresUnitTotal) {
        $('.modal-desenvolver-custo-rotulagem-valor-unit').val(formatarValorMoeda(valoresUnitTotal));
    }

    // Calcular o sub-total após o valor de rotulagem ser alterado
    calcularSubTotal3();
});

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

$(document).on('click', '.abre_modal_custo_produtivo', function () {
    $('#modalCustoProdutivo').modal('show');
    $('#modalCustoProdutivo').css('background-color', '#00000066');
    $('.btn-abre-modal-desenvolver-projeto').addClass('d-none');

})