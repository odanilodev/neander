var baseUrl = $('.base-url').val();


$(function () {

  // Função para formatar valores monetários
  function formatarValor(valor) {
    return valor
      .toFixed(2)
      .replace('.', ',')
      .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  // Função para enviar dados ao servidor
  function enviarDadosParaServidor(idEquipamento, custoProducao, valorInput, tipo, valorBase) {
    $.ajax({
      url: `${baseUrl}custoProdutivo/insereCustoProdutivo`,
      type: 'POST',
      data: {
        idEquipamento: idEquipamento,
        custoProducao: custoProducao.toFixed(2),
        valorInput: valorInput,
        tipo: tipo,
        valorBase: valorBase
      },
      success: function (response) {

        if (response.success) {

          $(`.load-form-${idEquipamento}`).addClass('d-none');
          $(`.input-equipamento-${tipo}`).attr('disabled', false);

          let idEquipamentoEnvase = $('#select-equipamentos-envase option:selected').val();
          let pcsHoraEquipamentoEnvase = $(`.equipamento-envase-${idEquipamentoEnvase}`).val();
        
          $('.modal-desenvolver-custo-envase-pecas-hora').val(pcsHoraEquipamentoEnvase);
        }
      },
      error: function (xhr, status, error) {
        console.error('Erro ao enviar dados:', error);
      }
    });
  }

  // Função para calcular custo de produção

  function calcularCustoProducao(tipoInput, sweetAlert, inputClasse, inputIndividualCompleto, envaseOuRotulagem, custoHora, valorClasse, calculaCustoProducao) {

    function atualizarCustos() {
      let valorBase = parseFloat($(custoHora).val().replace(/\./g, '').replace(',', '.')) || 0;

      if (tipoInput === 'input-individual') {
        // Atualiza custo para um único item
        let idEquipamento = $(inputIndividualCompleto).data(`id-equipamento-${envaseOuRotulagem}`);
        let valorInput = parseInt($(inputIndividualCompleto).val().replace(/\D/g, '')) || 0;
        let custoProducao = valorInput === 0 ? 0 : calculaCustoProducao(valorBase, valorInput);

        let custoProducaoFormatado = formatarValor(custoProducao);
        $(`.${valorClasse}-${idEquipamento}`).html('R$ ' + custoProducaoFormatado);

        enviarDadosParaServidor(idEquipamento, custoProducao, valorInput, envaseOuRotulagem, valorBase);
      } else {
        // Atualiza custos para múltiplos itens
        $(inputClasse).each(function () {
          let idEquipamento = $(this).data(`id-equipamento-${envaseOuRotulagem}`);
          let valorInput = parseInt($(this).val().replace(/\D/g, '')) || 0;
          let custoProducao = valorInput === 0 ? 0 : calculaCustoProducao(valorBase, valorInput);

          let custoProducaoFormatado = formatarValor(custoProducao);
          $(`.${valorClasse}-${idEquipamento}`).html('R$ ' + custoProducaoFormatado);

          enviarDadosParaServidor(idEquipamento, custoProducao, valorInput, envaseOuRotulagem, valorBase);
        });
      }
    }

    if (sweetAlert) {
      Swal.fire({
        title: 'Você tem certeza?',
        text: "Esta ação não poderá ser revertida e todos os campos serão atualizados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, atualizar campos'
      }).then((result) => {
        if (result.isConfirmed) {
          atualizarCustos();
          Swal.fire({
            title: 'Sucesso!',
            text: "Dados alterados com sucesso.",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Fechar'
          });
        }
      });
    } else {
      atualizarCustos();
    }
  }

  //===========================================================================================

  $('#inputCustoHoraEnvase').on('focus', function () {
    let $input = $(this);
    $input.data('valor-antigo', $input.val().replace(/\./g, '').replace(',', '.'));
  });

  $('#inputCustoHoraEnvase').on('focusout', function () {
    let $input = $(this);
    let valorAtual = parseFloat($input.val().replace(/\./g, '').replace(',', '.'));
    let valorAntigo = parseFloat($input.data('valor-antigo'));

    if (valorAtual !== valorAntigo) {
      calcularCustoProducaoEnvase(true, 'todos-inputs');
      $input.data('valor-antigo', valorAtual);
    }
  });

  $('.input-equipamento-envase').on('input', function () {
    calcularCustoProducaoEnvase(false, 'input-individual', this);
  });

  function calcularCustoProducaoEnvase(sweetAlert, tipoInput, inputIndividualCompleto) {
    calcularCustoProducao(
      tipoInput,
      sweetAlert,
      '.input-equipamento-envase',
      inputIndividualCompleto,
      'envase',
      '#inputCustoHoraEnvase',
      'valor-total-envase',
      (valorBase, pecasPorHora) => valorBase / pecasPorHora
    );
  }

  //===========================================================================================

  $('#inputCustoHoraRotulagem').on('focus', function () {
    let $input = $(this);
    $input.data('valor-antigo', $input.val().replace(/\./g, '').replace(',', '.'));
  });

  $('#inputCustoHoraRotulagem').on('focusout', function () {
    let $input = $(this);
    let valorAtual = parseFloat($input.val().replace(/\./g, '').replace(',', '.'));
    let valorAntigo = parseFloat($input.data('valor-antigo'));

    if (valorAtual !== valorAntigo) {
      calcularCustoProducaoRotulagem(true, 'todos-inputs');
      $input.data('valor-antigo', valorAtual);
    }
  });

  $('.input-equipamento-rotulagem').on('focusout', function () {
    calcularCustoProducaoRotulagem(false, 'input-individual', this);
  });

  function calcularCustoProducaoRotulagem(sweetAlert, tipoInput, inputIndividualCompleto) {
    calcularCustoProducao(
      tipoInput,
      sweetAlert,
      '.input-equipamento-rotulagem',
      inputIndividualCompleto,
      'rotulagem',
      '#inputCustoHoraRotulagem',
      'valor-total-rotulagem',
      (valorBase, pecasPorHora) => valorBase / pecasPorHora
    );
  }

  //===========================================================================================

  $('#inputCustoHoraManipulacao').on('focus', function () {
    let $input = $(this);
    $input.data('valor-antigo', $input.val().replace(/\./g, '').replace(',', '.'));
  });

  $('#inputCustoHoraManipulacao').on('focusout', function () {
    let $input = $(this);
    let valorAtual = parseFloat($input.val().replace(/\./g, '').replace(',', '.'));
    let valorAntigo = parseFloat($input.data('valor-antigo'));

    if (!isNaN(valorAtual) && valorAtual !== valorAntigo) {
      Swal.fire({
        title: 'Você tem certeza?',
        text: "O Valor do custo base de manipulação será alterado para " + formatarValor(valorAtual),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, atualizar campos'
      }).then((result) => {
        if (result.isConfirmed) {
          insereCustoProducaoManipulacao(valorAtual);
          $input.data('valor-antigo', valorAtual);
        } else {
          $input.val(formatarValor(valorAntigo));
        }
      });
    }
  });

  function insereCustoProducaoManipulacao(valorAtual) {
    $.ajax({
      url: `${baseUrl}/custoProdutivo/insereCustoHoraManipulacao`,
      type: 'POST',
      data: {
        valorBase: valorAtual.toFixed(2).replace('.', '.')
      },
      success: function (data) {
        avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, '#');
      },
      error: function (xhr, status, error) {
        console.error('Erro ao enviar dados:', error);
      }
    });
  }

  $(document).on('click', '.btn-abre-modal-custo-produtivo', function () {

    $('.btn-abre-modal-desenvolver-projeto').removeClass('d-none');

  })

});
