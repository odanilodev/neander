var baseUrl = $('.base-url').val();

$(function () {

  // Função para limpar os campos
  // $('.btn-limpar').on('click', function () {
  //   Swal.fire({
  //     title: 'Você tem certeza?',
  //     text: "Esta ação não poderá ser revertida e todos os campos da página atual serão zerados.",
  //     icon: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     cancelButtonText: 'Cancelar',
  //     confirmButtonText: 'Sim, limpar campos'
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       if ($('#tab-manipulacao').hasClass('active')) {
  //         $('.input-equipamento-manipulacao').val('');
  //         $('#inputCustoHoraManipulacao').val('');
  //         $('.valores-totais-manipulacao').text('R$ 0,00');
  //       } else if ($('#tab-envase').hasClass('active')) {
  //         $('.input-equipamento-envase').val('');
  //         $('#inputCustoHoraEnvase').val('');
  //         $('.valores-totais-envase').text('R$ 0,00');
  //       } else {
  //         $('.input-equipamento-rotulagem').val('');
  //         $('#inputCustoHoraRotulagem').val('');
  //         $('.valores-totais-rotulagem').text('R$ 0,00');
  //       }
  //     }
  //   });
  // });

  // Função para formatar valores monetários
  function formatarValor(valor) {
    return valor
      .toFixed(2)
      .replace('.', ',')
      .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  // Função para enviar dados ao servidor
  function enviarDadosParaServidor(idEquipamento, custoProducao, tempoProd, tipo, valorBase) {
    $.ajax({
      url: `${baseUrl}/custoProdutivo/insereCustoProdutivo`,
      type: 'POST',
      data: {
        idEquipamento: idEquipamento,
        custoProducao: custoProducao.toFixed(2),
        tempoProd: tempoProd,
        tipo: tipo,
        valorBase: valorBase
      }, success: function () {
        $(`.load-form-${idEquipamento}`).addClass('d-none');
        $(`.input-equipamento-${tipo}`).attr('disabled', false);
      }
    });
  }

  // Função para verificar e ajustar minutos no input
  function verificaInput(input) {

    if (input == '.input-equipamento-manipulacao') {
      $(input).each(function () {
        let valorAtual = $(this).val();
        let valorOriginal = $(this).data('valor-original') || valorAtual;

        if (valorAtual === valorOriginal) return;

        let [horas, minutos] = valorAtual.split(':').map(Number);
        minutos = minutos > 59 ? 59 : minutos;
        let horasFormatadas = String(horas || 0).padStart(2, '0');
        let minutosFormatados = String(minutos || 0).padStart(2, '0');

        $(this).val(`${horasFormatadas}:${minutosFormatados}`);
        $(this).data('valor-original', `${horasFormatadas}:${minutosFormatados}`);
      });
    }

  }

  function calcularCustoProducao(tipoInput, sweetAlert, inputTempo, inputIndividualId, dataIdNome, custoHoraId, valorClasse, func) {

    function atualizarCustos() {
      let valorBase = $(custoHoraId).val().replace(/\./g, '').replace(',', '.');
      valorBase = parseFloat(valorBase) || 0;

      if (tipoInput === 'input-individual') {
        // Atualiza custos para um único item
        let idEquipamento = $(inputIndividualId).data(`id-equipamento-${dataIdNome}`);

        let valorAtual = $(inputIndividualId).val();

        let custoProducao;

        if (dataIdNome === 'manipulacao') {
          // Manipulação - trata como tempo
          let [horas = 0, minutos = 0] = valorAtual.split(':').map(Number);
          minutos = Math.min(minutos, 59);
          let tempoProducaoDecimal = horas + (minutos / 60);
          custoProducao = func(valorBase, tempoProducaoDecimal);
        } else {
          // Envase e Rotulagem - trata como peças por hora
          let pecasPorHora = parseInt(valorAtual.replace(/\D/g, '')) || 0;
          if (pecasPorHora === 0) {
            custoProducao = 0;
          } else {
            custoProducao = func(valorBase, pecasPorHora);
          }
        }

        let custoProducaoFormatado = formatarValor(custoProducao);
        $(`.${valorClasse}-${idEquipamento}`).html('R$ ' + custoProducaoFormatado);

        enviarDadosParaServidor(idEquipamento, custoProducao, valorAtual, dataIdNome, valorBase);
      } else {
        // Atualiza custos para múltiplos itens
        $(inputTempo).each(function () {

          let idEquipamento = $(this).data(`id-equipamento-${dataIdNome}`);
          let valorAtual = $(this).val();
          let custoProducao;

          if (dataIdNome === 'manipulacao') {
            // Manipulação - trata como tempo
            let [horas = 0, minutos = 0] = valorAtual.split(':').map(Number);
            minutos = Math.min(minutos, 59);
            let tempoProducaoDecimal = horas + (minutos / 60);
            custoProducao = func(valorBase, tempoProducaoDecimal);
          } else {
            // Envase e Rotulagem - trata como peças por hora
            let pecasPorHora = parseInt(valorAtual.replace(/\D/g, '')) || 0;
            if (pecasPorHora === 0) {
              custoProducao = 0;
            } else {
              custoProducao = func(valorBase, pecasPorHora);
            }
          }

          let custoProducaoFormatado = formatarValor(custoProducao);
          $(`.${valorClasse}-${idEquipamento}`).html('R$ ' + custoProducaoFormatado);

          enviarDadosParaServidor(idEquipamento, custoProducao, valorAtual, dataIdNome, valorBase);
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
        }
      });
    } else {
      atualizarCustos();
    }
  }

  // Funções específicas para cálculos e eventos dos formulários
  function calcularCustoProducaoManipulacao(sweetAlert, tipoInput, inputIndividualId) {
    calcularCustoProducao(
      tipoInput,
      sweetAlert,
      '.input-equipamento-manipulacao',
      inputIndividualId,
      'manipulacao',
      '#inputCustoHoraManipulacao',
      'valor-total-manipulacao',
      (valorBase, tempoProducaoDecimal) => valorBase * tempoProducaoDecimal
    );
  }

  function calcularCustoProducaoEnvase(sweetAlert, tipoInput, inputIndividualId) {
    calcularCustoProducao(
      tipoInput,
      sweetAlert,
      '.input-equipamento-envase',
      inputIndividualId,
      'envase',
      '#inputCustoHoraEnvase',
      'valor-total-envase',
      (valorBase, pecasPorHora) => valorBase / pecasPorHora
    );
  }

  function calcularCustoProducaoRotulagem(sweetAlert, tipoInput, inputIndividualId) {
    calcularCustoProducao(
      tipoInput,
      sweetAlert,
      '.input-equipamento-rotulagem',
      inputIndividualId,
      'rotulagem',
      '#inputCustoHoraRotulagem',
      'valor-total-rotulagem',
      (valorBase, pecasPorHora) => valorBase / pecasPorHora
    );
  }

  // Event Handlers
  $('#inputCustoHoraManipulacao').on('focusout', function () {
    calcularCustoProducaoManipulacao(true, 'todos-inputs');
  });

  $('.input-equipamento-manipulacao').each(function () {
    $(this).data('valor-original', $(this).val());
  }).on('focusout', function () {
    verificaInput('.input-equipamento-manipulacao');
    calcularCustoProducaoManipulacao(false, 'input-individual', this);
  });

  $('#inputCustoHoraEnvase').on('focusout', function () {
    calcularCustoProducaoEnvase(true, 'todos-inputs');
  });

  $('.input-equipamento-envase').each(function () {
    $(this).data('valor-original', $(this).val());
  }).on('focusout', function () {
    verificaInput('.input-equipamento-envase');
    calcularCustoProducaoEnvase(false, 'input-individual', this);
  });

  $('#inputCustoHoraRotulagem').on('focusout', function () {
    calcularCustoProducaoRotulagem(true, 'todos-inputs');
  });

  $('.input-equipamento-rotulagem').each(function () {
    $(this).data('valor-original', $(this).val());
  }).on('focusout', function () {
    verificaInput('.input-equipamento-rotulagem');
    calcularCustoProducaoRotulagem(false, 'input-individual', this);
  });
});




