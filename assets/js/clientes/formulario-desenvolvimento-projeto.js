var baseUrl = $('.base-url').val();

$(function () {

    $('.select2').select2({
        dropdownParent: $('#modalDesenvolverProjeto'),
        theme: 'bootstrap-5',
    });

});

$('#modalCadastroMateriaPrima').on('hidden.bs.modal', function () {
    $('.select2').select2({
        dropdownParent: $('#modalDesenvolverProjeto'),
        theme: 'bootstrap-5',
    });
});


const modalDesenvolverProjeto = () => {

    $('.select2').select2({
        dropdownParent: $('#modalDesenvolverProjeto'),
        theme: 'bootstrap-5',
    });

    $('.modal-desenvolver-input-fase').attr('disabled', true);
    $('.modal-desenvolver-input-percentual').attr('disabled', true);
    $('.btn-duplica-linha').attr('disabled', true);

    $('#select_projeto_cliente').val(null).trigger('change');

    $('#alerta-selecione-campos').fadeIn(1000);
    $('.container-modal-desenvolver-projeto').addClass('d-none');

    $('.modal-body-desenvolver-projeto').find(':input').val('');

    $('.campo-obrigatorio').each(function () {
        $(this).removeClass('invalido');
        $(this).next().removeClass('select2-obrigatorio');
    });

    recebeMateriasPrimas();
    $('.btn-desenvolver-projeto').addClass('d-none');

};


$(document).on('change', '#select_projeto_cliente', function () {

    if ($(this).val()) {
        $('#modalDesenvolverProjetoTitulo').html($(this).find('option:selected').text() + " | Versão: " + $(this).find('option:selected').data('versao-projeto') + " | Código: " + $(this).find('option:selected').val());
    } else {
        $('#modalDesenvolverProjetoTitulo').html("Selecione o projeto que deseja desenvolver!");
    }

    let hoje = new Date().toISOString().split('T')[0];
    $('.modal-desenvolver-input-data').val(formatarDatas(hoje));
    $('.modal-desenvolver-input-producao').val('1,000 g');

    let nomeProduto = $(this).find('option:selected').data('nome-produto');
    let nomeFantasia = $(this).find('option:selected').data('nome-fantasia');

    $('.modal-desenvolver-input-nome-produto').val(nomeProduto);
    $('.modal-desenvolver-input-nome-cliente').val(nomeFantasia);

    $('.container-modal-desenvolver-projeto').removeClass('d-none');

    if ($(this).val()) {
        $('#alerta-selecione-campos').fadeOut(1000);;

        $('.remover-linhas').trigger('click');
        $('.aviso-obrigatorio').addClass('d-none')
        $('.input-porcentagem-total').removeClass('invalido')
    }

    $('.btn-desenvolver-projeto').removeClass('d-none');

    let custoClienteProduto = $(this).find('option:selected').data('custo-produto');
    let custoClienteEmbalagem = $(this).find('option:selected').data('custo-embalagem');
    let custoClienteRotulo = $(this).find('option:selected').data('custo-rotulo')

    $('.custo-cliente-produto').val(formatarValorMoeda(custoClienteProduto));
    $('.custo-cliente-embalagem').val(formatarValorMoeda(custoClienteEmbalagem));
    $('.custo-cliente-rotulo').val(formatarValorMoeda(custoClienteRotulo));
});

$(document).on('input', '.modal-desenvolver-input-quantidade', function () {

    calculaQuantidade();
    calculaTotalManipulacao();
    calculaTotalLinhaEnvaseRotulagem('envase');
    calculaTotalLinhaEnvaseRotulagem('rotulagem');
    calcularSubTotal3();

    calculaLinhaEmbalagem('.input-valor-unit-embalagem');
    calculaSubTotal4();

    calculaValorUnitCustoFinalProduto(valorSubTotalGlobal);
    calculaValorUnitCustoFinalManipulacao(valorSubTotal2Global);
    calculaValorUnitCustoFinalEnvase(valorEnvaseGlobal);
    calculaValorUnitCustoFinalRotulagem(valorRotulagemGlobal);
    calculaValorUnitCustoFinalEmbalagem(valorEmbalagemGlobal);

    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-produto').val(), '.input-custo-final-total-produto');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-manipulacao').val(), '.input-custo-final-total-manipulacao');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-envase').val(), '.input-custo-final-total-envase');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-rotulagem').val(), '.input-custo-final-total-rotulagem');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-embalagem').val(), '.input-custo-final-total-embalagem');

    calculaTotalUnitCustoFinal();
    calculaTotalGeralCustoFinal();

})

//========================================= Matérias Primas

function recebeMateriasPrimas() {

    let valoresSelecionados = [];
    $('.modal-desenvolver-select-materia-prima').each(function () {
        valoresSelecionados.push($(this).val());
    });

    $.ajax({
        type: 'post',
        url: `${baseUrl}materiasPrimas/recebeTodasMateriasPrimas`,
        success: function (response) {
            if (response.success) {
                let materiasPrimas = '<option value="" selected disabled>Selecione a Matéria Prima</option>';

                $(response.materias).each(function (index, materias) {
                    materiasPrimas += `<option value="${materias.id}" data-valor-materia-prima="${materias.valor}">${materias.nome}</option>`;
                });

                $('.modal-desenvolver-select-materia-prima').html(materiasPrimas);

                $('.modal-desenvolver-select-materia-prima').each(function (index) {

                    $(this).val(valoresSelecionados[index]);

                });

            } else {
                avisoRetorno(response.title, response.message, response.type, '#');
            }
        }
    });
}

$(document).on('change', '.modal-desenvolver-select-materia-prima', function () {
    const divMateriaPrima = $(this).closest('.div-materia-prima');
    const valorMateriaPrima = parseFloat(divMateriaPrima.find('.modal-desenvolver-select-materia-prima option:selected').data('valor-materia-prima')) || 0;

    atualizarTotalLinha(divMateriaPrima, valorMateriaPrima);
    calcularPorcentagemESubtotal(divMateriaPrima);

    if ($(this).is($('.modal-desenvolver-select-materia-prima').last())) {
        $('.modal-desenvolver-input-fase').attr('disabled', false);
        $('.modal-desenvolver-input-percentual').attr('disabled', false);
        $('.novo-input-materia-prima').attr('disabled', false);
        $('.btn-duplica-linha').attr('disabled', false);
    }
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
    divMateriaPrima.siblings('.div-total-linha').find('input').val('R$ ' + valorTotalLinha.toFixed(3).replace('.', ','));
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

    if (valorTotal > 100) {
        $('.aviso-porcentagem').removeClass('d-none')
        $('.input-porcentagem-total').addClass('invalido')
    } else {
        $('.aviso-porcentagem').addClass('d-none')
        $('.input-porcentagem-total').removeClass('invalido')
    }

    $('.input-porcentagem-total').val(valorTotal.toFixed(2).replace('.', ','));

}

let valorSubTotalGlobal = 0;
function calculaSubTotal1() {
    let valorSubTotal = 0;
    $('.modal-desenvolver-input-total-materia-prima').each(function () {
        let valorTotal = $(this).val().replace('R$', '').replace('.', '').replace(',', '.');
        valorSubTotal += parseFloat(valorTotal) || 0;
    });

    valorSubTotalGlobal = valorSubTotal; // Armazena o subtotal na variável global
    $('.input-sub-total').val(formatarValorMoeda(valorSubTotal));
}

$(document).on('click', '.btn-duplica-linha', function () {
    duplicarLinhas();

    carregaSelect2('select2', 'modalDesenvolverProjeto');
});

function duplicarLinhas() {
    let optionsMateriaPrima = $('#select_materia_prima_main').html();

    let novaLinha = $(`
        <div class="row mb-1 inputs-materia-prima linhas-materias-primas-duplicadas">
            <div class="col-md-4 div-materia-prima">
                <select name="id_materia_prima" class="input-materia-prima form-control campo-briefing select2 modal-desenvolver-select-materia-prima" name="select-materia-prima">
                    ${optionsMateriaPrima}
                </select>
            </div>
            <div class="col-md-1 div-fase">
                <input disabled name="fase" type="text" class="inputs-tipo-texto mascara-fase form-control input-materia-prima form-control modal-desenvolver-input-fase">
            </div>
            <div class="col-md-2 div-percentual">
                <div class="input-group">
                    <input disabled name="percentual" type="number" class="input-materia-prima form-control modal-desenvolver-input-percentual">
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <div class="col-md-2 div-quantidade">
                <div class="input-group">
                    <input name="quantidade" type="text" disabled class="input-materia-prima text-1000 mascara-peso form-control modal-desenvolver-input-quantidade-materia-prima">
                    <span class="input-group-text">KG.</span>
                </div>
            </div>
            <div class="col-md-2 div-total-linha">
                <input name="total" type="text" value="" disabled class="input-materia-prima text-1000 form-control modal-desenvolver-input-total-materia-prima">
            </div>
            <div class="col-md-1 add-botao-mais p-0">
                <button class="btn btn-phoenix-danger remover-linhas px-3" style="padding: 10px; margin-bottom: 5px;">-</button>
                <button disabled class="btn btn-phoenix-success btn-duplica-linha px-3" style="padding: 10px; margin-bottom: 5px;">+</button>
            </div>
        </div>
    `);

    // Remove o botão + da linha atual
    $('.btn-duplica-linha').last().hide();

    $('.campos-duplicados').append(novaLinha);

    $('.mascara-fase').mask('A00', {
        translation: {
            'A': { pattern: /[A-Za-z]/, optional: true, recursive: false },
            '0': { pattern: /[0-9]/ }
        },
        onKeyPress: function (value, e, field, options) {
            value = value.toUpperCase();
            $(field).val(value);
        }
    });

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
    let percentual = quantidade * 100;

    percentualInput.val(percentual.toFixed(2).replace('.', ','));
    let valorMateriaPrima = parseFloat(divMateriaPrima.find('.modal-desenvolver-select-materia-prima option:selected').data('valor-materia-prima')) || 0;


    calculaTotalLinha(valorMateriaPrima, quantidade, divMateriaPrima);
});

$(document).on('change', '.select-principal-materia-prima', function () {
    $('.modal-desenvolver-input-percentual-principal').val(100);
    $('.modal-desenvolver-input-percentual-principal').trigger('focusout');
});

//========================================= Manipulação

$('#select-equipamentos-manipulacao').on('change', function () {
    calculaQuantidade();
    calculaTotalManipulacao();
    calculaValorUnitCustoFinalProduto(valorSubTotalGlobal);
    calculaTotalLinhaCustoFinal()
});

let valorSubTotal2Global = 0;
const calculaTotalManipulacao = () => {
    let valorSubtotal2 = 0;
    let custoHoraManipulacao = $('#select-equipamentos-manipulacao option:selected').data('custo-hora');
    let tempoManipulacao = $('.modal-desenvolver-custo-manipulacao-tempo').val();

    let partes = tempoManipulacao.split(':');
    let horas = parseFloat(partes[0]) + parseFloat(partes[1]) / 60 + parseFloat(partes[2]) / 3600;

    let total = horas * custoHoraManipulacao;

    valorSubTotal2Global = total;

    $('.modal-desenvolver-custo-manipulacao-valor-unit').val(formatarValorMoeda(total));
}

const calculaQuantidade = () => {
    let quantidadeManipulacao = $('.input-quantidade-manipulacao').val();
    let quantidadeGeral = $('.modal-desenvolver-input-quantidade').val();

    quantidadeManipulacao = parseFloat(quantidadeManipulacao.replace(',', '.')) || 0;
    quantidadeGeral = parseFloat(quantidadeGeral.replace(',', '.')) || 0;

    let quantidade = 0;

    if (quantidadeGeral !== 0) {
        quantidade = quantidadeManipulacao / quantidadeGeral;
    }

    let quantidadeFormatada = quantidade % 1 === 0 ? quantidade.toString() : quantidade.toFixed(2).replace(/\.?0+$/, '');

    $('.input-quantidade').val(quantidadeFormatada);

}

$('.modal-desenvolver-custo-manipulacao-tempo').on('focusout', function () {
    calculaQuantidade();
    calculaTotalManipulacao();
    calculaTotalLinhaCustoFinal()

    calculaValorUnitCustoFinalProduto(valorSubTotalGlobal);
    calculaValorUnitCustoFinalManipulacao(valorSubTotal2Global);
    calculaValorUnitCustoFinalEnvase(valorEnvaseGlobal);

    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-produto').val(), '.input-custo-final-total-produto');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-manipulacao').val(), '.input-custo-final-total-manipulacao');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-envase').val(), '.input-custo-final-total-envase');

});

$('.input-quantidade-manipulacao').on('focusout', function () {

    calculaQuantidade();
    calculaTotalManipulacao();
    calculaTotalLinhaEnvaseRotulagem('envase');
    calculaTotalLinhaEnvaseRotulagem('rotulagem');
    calcularSubTotal3();

    calculaLinhaEmbalagem('.input-valor-unit-embalagem');
    calculaSubTotal4();

    calculaValorUnitCustoFinalProduto(valorSubTotalGlobal);
    calculaValorUnitCustoFinalManipulacao(valorSubTotal2Global);
    calculaValorUnitCustoFinalEnvase(valorEnvaseGlobal);
    calculaValorUnitCustoFinalRotulagem(valorRotulagemGlobal);
    calculaValorUnitCustoFinalEmbalagem(valorEmbalagemGlobal);

    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-produto').val(), '.input-custo-final-total-produto');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-manipulacao').val(), '.input-custo-final-total-manipulacao');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-envase').val(), '.input-custo-final-total-envase');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-rotulagem').val(), '.input-custo-final-total-rotulagem');
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-embalagem').val(), '.input-custo-final-total-embalagem');

    calculaTotalUnitCustoFinal();
    calculaTotalGeralCustoFinal();

    exibeLotePartida($(this).val());

});

const exibeLotePartida = (quantidadeKg) => {

    if (quantidadeKg > 560) {
        $('.text-lote-partida').val('Lote 1000 KG');
    } else if (quantidadeKg > 340) {
        $('.text-lote-partida').val('Lote 560 KG');
    } else if (quantidadeKg > 100) {
        $('.text-lote-partida').val('Lote 340 KG');
    } else if (quantidadeKg == 100) {
        $('.text-lote-partida').val('Lote 100 KG');
    } else if (quantidadeKg <= 99 && quantidadeKg > 0) {
        $('.text-lote-partida').val('Lote Artesanal');
    } else {
        $('.text-lote-partida').val('Quantidade não definida.');
    }

}

//========================================= Envase + Rotulagem
let valorEnvaseGlobal = 0;
let valorRotulagemGlobal = 0;
const calculaTotalLinhaEnvaseRotulagem = (tipo) => {

    let quantidade = $(`.input-quantidade-${tipo}`).val();
    let valoresUnitTotal = $(`#select-equipamentos-${tipo}`).find('option:selected').data(`valores-unit-total-${tipo}`);
    let valorTotal = quantidade * valoresUnitTotal;

    if (tipo == 'envase') {
        valorEnvaseGlobal = valorTotal;
    } else {
        valorRotulagemGlobal = valorTotal;
    }

    $(`.modal-desenvolver-custo-${tipo}-valor-unit`).val(formatarValorMoeda(valoresUnitTotal));
    $(`.modal-desenvolver-custo-${tipo}-valor-total`).val(formatarValorMoeda(valorTotal));

    calcularSubTotal3();

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

    calculaTotalLinhaEnvaseRotulagem('envase');
    calcularSubTotal3();
    calculaValorUnitCustoFinalEnvase(valorEnvaseGlobal);
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-envase').val(), '.input-custo-final-total-envase');

});

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


    calculaTotalLinhaEnvaseRotulagem('rotulagem');
    calcularSubTotal3();
    calculaValorUnitCustoFinalRotulagem(valorRotulagemGlobal);
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-rotulagem').val(), '.input-custo-final-total-rotulagem');
});

function calcularSubTotal3() {
    let totalEnvase = parseFloat($('.modal-desenvolver-custo-envase-valor-total').val().replace('R$', '').replace(',', '.')) || 0;
    let totalRotulagem = parseFloat($('.modal-desenvolver-custo-rotulagem-valor-total').val().replace('R$', '').replace(',', '.')) || 0;

    let subTotal3 = totalEnvase + totalRotulagem;

    $('.input-sub-total-3').val(formatarValorMoeda(subTotal3));
}

//========================================== Embalagem

const calculaLinhaEmbalagem = (inputValorUnitEmbalagem) => {
    const linhaAtual = $(inputValorUnitEmbalagem).closest('.row');

    const quantidade = parseFloat(linhaAtual.find('.input-quantidade').val()) || 0;
    const valorUnit = parseFloat($(inputValorUnitEmbalagem).val().replace(',', '.')) || 0;

    const total = quantidade * valorUnit;
    linhaAtual.find('.input-total-linha-embalagem').val(formatarValorMoeda(total));

    calculaTotalUnitCustoFinal();
    calculaTotalGeralCustoFinal();
}

let valorEmbalagemGlobal = 0;
const calculaSubTotal4 = () => {
    let subTotal4 = 0;

    $('.input-total-linha-embalagem').each(function () {
        const totalLinha = parseFloat($(this).val().replace('R$', '').replace('.', '').replace(',', '.')) || 0;
        subTotal4 += totalLinha;
    });

    valorEmbalagemGlobal = subTotal4;

    $('.input-sub-total-4').val(formatarValorMoeda(subTotal4));
}

$(document).on('focusout', '.input-valor-unit-embalagem', function () {
    calculaLinhaEmbalagem(this);
    calculaSubTotal4();
    calculaValorUnitCustoFinalEmbalagem(valorEmbalagemGlobal);
    calculaTotalLinhaCustoFinal($('.input-custo-final-valor-unit-embalagem').val(), '.input-custo-final-total-embalagem');

});

//========================================== Custo Final

const calculaValorUnitCustoFinalProduto = (valorSubTotalGlobal) => {
    const quantidade = parseFloat($('.input-quantidade').val().replace(',', '.')) || 0;
    const quantidadeManipulacao = parseFloat($('.input-quantidade-manipulacao').val().replace(',', '.')) || 0;
    const valorSubTotal1 = parseFloat(valorSubTotalGlobal) || 0;

    // Verifica se quantidade ou quantidadeManipulacao é zero
    if (quantidade === 0 || quantidadeManipulacao === 0) {
        $('.input-custo-final-valor-unit-produto').val(formatarValorMoeda(0));
        return;
    }

    const totalValorUnitProduto = (quantidadeManipulacao * valorSubTotal1) / quantidade;

    $('.input-custo-final-valor-unit-produto').val(formatarValorMoeda(totalValorUnitProduto));

    calculaTotalUnitCustoFinal()
}

const calculaValorUnitCustoFinalManipulacao = (valorSubTotal2Global) => {

    const quantidade = $('.input-quantidade').val();
    const valorSubtotal2 = parseFloat(valorSubTotal2Global) || 0;

    if (quantidade == 0 || valorSubtotal2 == 0) {
        $('.input-custo-final-valor-unit-manipulacao').val(formatarValorMoeda(0));
        return;
    }

    const totalValorUnitManipulacao = valorSubtotal2 / quantidade;

    $('.input-custo-final-valor-unit-manipulacao').val(formatarValorMoeda(totalValorUnitManipulacao));

    calculaTotalUnitCustoFinal();
}

const calculaValorUnitCustoFinalEnvase = (valorEnvaseGlobal) => {

    const quantidade = $('.input-quantidade').val();
    const valorEnvase = parseFloat(valorEnvaseGlobal) || 0;

    if (quantidade == 0 || valorEnvase == 0) {
        $('.input-custo-final-valor-unit-envase').val(formatarValorMoeda(0));
        return;
    }

    const totalValorUnitlEnvase = valorEnvase / quantidade;

    $('.input-custo-final-valor-unit-envase').val(formatarValorMoeda(totalValorUnitlEnvase));

    calculaTotalUnitCustoFinal();

}

const calculaValorUnitCustoFinalRotulagem = (valorRotulagemGlobal) => {

    const quantidade = $('.input-quantidade').val();
    const valorRotulagem = parseFloat(valorRotulagemGlobal) || 0;

    if (quantidade == 0 || valorRotulagem == 0) {
        $('.input-custo-final-valor-unit-rotulagem').val(formatarValorMoeda(0));
        return;
    }

    const totalValorUnitlRotulagem = valorRotulagem / quantidade;

    $('.input-custo-final-valor-unit-rotulagem').val(formatarValorMoeda(totalValorUnitlRotulagem));

    calculaTotalUnitCustoFinal();

}

const calculaValorUnitCustoFinalEmbalagem = (valorEmbalagemGlobal) => {

    const quantidade = $('.input-quantidade').val();
    const valorEmbalagem = parseFloat(valorEmbalagemGlobal) || 0;

    if (quantidade == 0 || valorEmbalagem == 0) {
        $('.input-custo-final-valor-unit-embalagem').val(formatarValorMoeda(0));
        return;
    }

    const totalValorUnitEmbalagem = valorEmbalagem / quantidade;

    $('.input-custo-final-valor-unit-embalagem').val(formatarValorMoeda(totalValorUnitEmbalagem));

    calculaTotalUnitCustoFinal();

}

const calculaTotalLinhaCustoFinal = (valor, inputTotalLinha) => {

    if (valor) {
        const quantidade = parseFloat($('.input-quantidade').val().replace(',', '.')) || 0;
        const valorNumerico = parseFloat(valor.replace('R$', '').replace('.', '').replace(',', '.')) || 0;

        let totalLinha = valorNumerico * quantidade;

        $(`${inputTotalLinha}`).val(formatarValorMoeda(totalLinha));

        //Exibir valor em custo lote partida
        $(`${inputTotalLinha}-lote-partida`).val(formatarValorMoeda(totalLinha));

        if (inputTotalLinha == '.input-custo-final-total-manipulacao' || '.input-custo-final-total-envase' || '.input-custo-final-total-rotulagem') {

            calculaTotalMaoDeObraLotePartida();

        } else if (inputTotalLinha == '.input-custo-final-total-perda') {

            $('.input-custo-final-total-perda-lote-partida').val(formatarValorMoeda(valorFinalTotal));
        }
    }

    calculaTotalUnitCustoFinal();
}

const calculaTotalMaoDeObraLotePartida = () => {

    const valorManipulacao = converterParaFloat($('.input-custo-final-total-manipulacao').val()) || 0;
    const valorEnvase = converterParaFloat($('.input-custo-final-total-envase').val()) || 0;
    const valorRotulagem = converterParaFloat($('.input-custo-final-total-rotulagem').val()) || 0;

    const valorTotalMaoDeObra = valorManipulacao + valorEnvase + valorRotulagem;

    $('.input-custo-final-total-mao-de-obra-lote-partida').val(formatarValorMoeda(valorTotalMaoDeObra));

}

//----------- Outros Custos -----------//
$(document).on('focusout', '.input-custo-final-quantidade-outros-custos, .input-custo-final-valor-unit-outros-custos', function () {
    calculaTotalLinhaOutrosCustos();
    calculaTotalUnitCustoFinal();
    calculaTotalGeralCustoFinal();
});

const calculaTotalLinhaOutrosCustos = () => {
    const quantidadeOutrosCustos = converterParaFloat($('.input-custo-final-quantidade-outros-custos').val());
    const valorUnitOutrosCustos = converterParaFloat($('.input-custo-final-valor-unit-outros-custos').val());

    const valorTotalOutrosCustos = quantidadeOutrosCustos * valorUnitOutrosCustos;

    $('.input-custo-final-total-outros-custos').val(formatarValorMoeda(valorTotalOutrosCustos));

};

//----------- Percentual Perda  -----------//
$(document).on('focusout', '.input-quantidade-percentual-perda', function () {

    if (!isNaN($(this).val())) {
        const valorPercentual = parseFloat($(this).val().replace(',', '.')) / 100 || 0;

        const calcularTotal = (campos) => {
            return campos.reduce((somaTotal, campo) => somaTotal + converterParaFloat(campo.val()), 0);
        };

        const custosFinaisUnitarios = [
            $('.input-custo-final-valor-unit-produto'),
            $('.input-custo-final-valor-unit-manipulacao'),
            $('.input-custo-final-valor-unit-envase'),
            $('.input-custo-final-valor-unit-rotulagem'),
            $('.input-custo-final-valor-unit-embalagem')
        ];

        const custosFinaisTotais = [
            $('.input-custo-final-total-produto'),
            $('.input-custo-final-total-manipulacao'),
            $('.input-custo-final-total-envase'),
            $('.input-custo-final-total-rotulagem'),
            $('.input-custo-final-total-embalagem')
        ];

        const valorFinalUnitario = calcularTotal(custosFinaisUnitarios) * valorPercentual;
        const valorFinalTotal = calcularTotal(custosFinaisTotais) * valorPercentual;

        $('.input-custo-final-valor-unit-percentual-perda').val(formatarValorMoeda(valorFinalUnitario));
        $('.input-custo-final-total-percentual-perda').val(formatarValorMoeda(valorFinalTotal));

        calculaTotalUnitCustoFinal();
        calculaTotalGeralCustoFinal();

        $('.input-custo-final-total-percentual-perda-lote-partida').val(formatarValorMoeda(valorFinalTotal));

    } else {

        $(this).val(0);

        $('.input-custo-final-valor-unit-percentual-perda').val(formatarValorMoeda(0));
        $('.input-custo-final-total-percentual-perda').val(formatarValorMoeda(0));

        calculaTotalUnitCustoFinal();
        calculaTotalGeralCustoFinal();

        $('.input-custo-final-total-percentual-perda-lote-partida').val(formatarValorMoeda(0));

    }

});

//----------------------------------------//

const calculaTotalUnitCustoFinal = () => {

    const custosUnitFinais = [
        $('.input-custo-final-valor-unit-produto'),
        $('.input-custo-final-valor-unit-manipulacao'),
        $('.input-custo-final-valor-unit-envase'),
        $('.input-custo-final-valor-unit-rotulagem'),
        $('.input-custo-final-valor-unit-embalagem'),
        $('.input-custo-final-valor-unit-outros-custos'),
        $('.input-custo-final-valor-unit-percentual-perda')
    ];

    const totalUnitFinal = custosUnitFinais.reduce((somaTotal, campo) => {
        return somaTotal + converterParaFloat(campo.val());
    }, 0);

    $('.input-custo-final-total-unit').val(formatarValorMoeda(totalUnitFinal));
}

const calculaTotalGeralCustoFinal = () => {

    const custosFinais = [
        $('.input-custo-final-total-produto'),
        $('.input-custo-final-total-manipulacao'),
        $('.input-custo-final-total-envase'),
        $('.input-custo-final-total-rotulagem'),
        $('.input-custo-final-total-embalagem'),
        $('.input-custo-final-total-outros-custos'),
        $('.input-custo-final-total-percentual-perda')
    ];

    const totalFinal = custosFinais.reduce((somaTotal, campo) => {
        return somaTotal + converterParaFloat(campo.val());
    }, 0);

    $('.input-custo-final-total-geral').val(formatarValorMoeda(totalFinal));
}

//==========================================

$(document).on('click', '.abre_modal_custo_produtivo', function () {
    $('#modalCustoProdutivo').modal('show');
    $('#modalCustoProdutivo').css('background-color', '#00000066');
    $('.btn-abre-modal-desenvolver-projeto').addClass('d-none');
})

$(document).on('click', '.abre_modal_cadastro_materia_prima', function () {

    $('.select2').select2({
        dropdownParent: $('#modalCadastroMateriaPrima'),
        theme: 'bootstrap-5',
    });

    $('#modalCadastroMateriaPrima').modal('show');
    $('#modalCadastroMateriaPrima').css('background-color', '#00000066');
    $('#modalCadastroMateriaPrima').find(':input').val(null);
})

//========================================== Desenvolver Projeto

const desenvolverProjeto = (idClienteRedirect) => {

    let idProjeto = $('#select_projeto_cliente option:selected').data('id-projeto');

    let codigoProjeto = $('#select_projeto_cliente').val();
    let versaoProjeto = $('#select_projeto_cliente option:selected').data('versao-projeto');

    let permissao = verificaCamposObrigatorios('campo-obrigatorio');

    if (permissao) {

        let inputsProjeto = {};

        inputsProjeto['versao_projeto'] = versaoProjeto;

        $('.inputs-projeto').find(':input').each(function () {
            if ($(this).hasClass('inputs-tipo-texto')) {
                inputsProjeto[$(this).attr('name')] = $(this).val();
            } else {
                inputsProjeto[$(this).attr('name')] = converterParaFloat($(this).val());
            }
        });

        let materiasPrimas = {};
        $('.inputs-materia-prima').each(function (index) {
            materiasPrimas[index] = {};

            $(this).find('.input-materia-prima').each(function () {
                let nameInput = $(this).attr('name');

                if ($(this).hasClass('inputs-tipo-texto')) {
                    materiasPrimas[index][nameInput] = $(this).val();
                } else {
                    materiasPrimas[index][nameInput] = converterParaFloat($(this).val()).toFixed(3);

                }

            });
        });


        $.ajax({
            type: 'POST',
            url: `${baseUrl}desenvolverProjeto/insereDesenvolvimentoProjeto`,
            data: {
                idProjeto: idProjeto,
                codigoProjeto: codigoProjeto,
                versaoProjeto: versaoProjeto,
                inputsProjeto: inputsProjeto,
                materiasPrimas: materiasPrimas
            },
            success: function (data) {
                if (data.success) {

                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.type,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Não',
                        confirmButtonText: 'Sim, redirecionar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `${baseUrl}precoVenda`
                        } else {
                            window.location.href = `${baseUrl}clientes/detalhes/${idClienteRedirect}`;
                        }
                    });

                } else {

                    avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, `#`);

                }
            },
            error: function (xhr, status, error) {
                console.error('Erro na requisição:', status, error);
                alert('Erro na requisição. Por favor, tente novamente.');
            }
        });
    }
};

////////////////////////////////////



