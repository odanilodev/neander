var baseUrl = $('.base-url').val();

$(function () {

  // Função para manipular o CEP
  function manipularCEP() {
    let cep = $(this).val().replace(/\D/g, '');

    if (cep.length !== 8 && cep.length >= 1) {
      avisoRetorno('CEP inválido', 'Verifique se digitou corretamente!', 'error', '#');
      return;
    }

    $('.input-rua, .input-bairro, .input-cidade, .input-estado').prop('disabled', true);

    preencherEnderecoPorCEP(cep, function (retornoViaCep) {
      $('.input-rua, .input-bairro, .input-cidade, .input-estado').prop('disabled', false);

      if (retornoViaCep.erro) {
        avisoRetorno(retornoViaCep.titulo, retornoViaCep.mensagem, retornoViaCep.type, '#');
      } else {
        $('.input-rua').val(retornoViaCep.logradouro);
        $('.input-bairro').val(retornoViaCep.bairro);
        $('.input-cidade').val(retornoViaCep.localidade);
        $('.input-estado').val(retornoViaCep.uf);
      }
    });
  }

  $('.input-cep').on('blur', manipularCEP);

});



const cadastraCliente = () => {

  let formData = new FormData();

  formData.append('id', $('.input-id').val());
  formData.append('razao_social', $('.input-razao-social').val());
  formData.append('nome_fantasia', $('.input-nome-fantasia').val());
  formData.append('cnpj', $('.input-cnpj').val());
  formData.append('contato', $('.input-contato-pessoa').val());
  formData.append('cidade', $('.input-cidade').val());
  formData.append('estado', $('.input-estado').val());
  formData.append('telefone', $('.input-telefone').val());
  formData.append('email', $('.input-email').val());

  // Verificação de campo vazio e permissão para cadastrar
  let permissao = verificaCamposObrigatorios('input-obrigatorio');

  if (permissao) {
    $.ajax({
      type: "post",
      url: `${baseUrl}clientes/cadastraCliente`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $('.load-form').removeClass('d-none');
        $('.btn-envia').addClass('d-none');
      },
      success: function (data) {
        $('.load-form').addClass('d-none');
        $('.btn-envia').removeClass('d-none');

        let redirect = data.type != 'error' ? `${baseUrl}clientes/index/all` : '#';
        avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, `${redirect}`);
      },
      error: function (xhr, status, error) {
        if (xhr.status === 403) {
          avisoRetorno('Algo deu errado!', `Você não tem permissão para esta ação..`, 'error', '#');
        }
      }
    });
  }
};

const deletaCliente = (id) => {
  Swal.fire({
    title: 'Você tem certeza?',
    text: "Esta ação não poderá ser revertida",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, deletar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'post',
        url: `${baseUrl}clientes/deletaCliente`,
        data: {
          id: id
        },
        success: function (data) {
          let redirect = data.type != 'error' ? `${baseUrl}clientes/index/all` : '#';

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

$(document).on('click', '.switch-status', function () {

  let status = $(this).prop('checked') ? 1 : 0;
  let id = $(this).data('id');
  let label = $(this).next('label');

  label.html(status == 1 ? 'Ativo' : 'Inativo');

  $.ajax({
    type: 'post',
    url: `${baseUrl}clientes/alteraStatusCliente`,
    data: {
      id: id,
      status: status
    },
    success: function (data) {

      if (data.success && status == 1) {
        $('.switch-status').removeClass('bg-secondary').addClass('bg-success');
      } else {
        $('.switch-status').removeClass('bg-success').addClass('bg-secondary');
      }
    }
  });
});

$(document).on('click', '.abre_modal_niveis', function () {
  $('#modalNiveisProdutos').modal('show');
  $('#modalNiveisProdutos').css('background-color', '#00000066');
})

const preencherModalComDados = (dados) => {
  Object.keys(dados).forEach(campo => {
    const seletor = `.modal-visualizar-${campo.toLowerCase().replace(/_/g, '-')}`;

    if ($(seletor).length > 0) {
      let valor = dados[campo];

      switch (true) {
        case campo === 'custo_sub_total_1':
        case campo === 'custo_total':
        case campo === 'total_materia_prima':
        case campo.startsWith('lote_partida_'):
          valor = formatarValorMoeda(valor);
          break;

        case campo === 'criado_em':
        case campo === 'editado_em':
          valor = formatarDatasComHora(valor);
          break;

        case campo === 'quantidade_geral_projeto':
          valor = valor.replace('.', ',') + ' g';
          break;

        case campo === 'quantidade_manipulacao':
        case campo === 'pcs_hora_envase':
        case campo === 'pcs_hora_rotulagem':
        case campo === 'quantidade_final':
        case campo === 'custo_outros':
        case campo === 'custo_perda':
          valor = parseInt(valor);
          break;

        case campo.startsWith('custo_'):
        case campo.startsWith('valor_'):
          valor = formatarValorMoeda(valor);
          break;
      }

      // Verifica se o campo usa select2 e dá trigger change
      if ($(seletor).hasClass('select2-hidden-accessible')) {
        $(seletor).addClass('inactive');
        $(seletor).val(valor).trigger('change');
      } else {
        $(seletor).val(valor);
      }

      if (campo === 'porcentagem_total') {
        if (valor > 100) {
          $('.modal-visualizar-aviso-porcentagem').removeClass('d-none');
          $('.modal-visualizar-porcentagem-total').addClass('invalido');
        }
      }
    }
  });
}



const visualizarDesenvolvimentoProjeto = (codigoProjeto, versaoProjeto) => {

  $('#modalVisualizarDesenvolvimentoProjeto').modal('show');
  $('#modalVisualizarDesenvolvimentoProjeto').find(':input').attr('disabled', true);
  $('#modalVisualizarDesenvolvimentoProjeto').find(':input').addClass('text-1000');

  $('#alerta-apenas-visualizacao').hide();
  $('#alerta-apenas-visualizacao').removeClass('d-none').fadeIn(2000);

  let nomeProjeto = $('.texto-titulo').html();

  $('#modalVisualizarDesenvolvimentoProjetoLabel').html(nomeProjeto);

  $.ajax({
    type: 'post',
    url: `${baseUrl}projetos/recebeProjetoClienteCodigo`,
    data: {
      codigoProjeto: codigoProjeto,
      versaoProjeto: versaoProjeto
    },
    success: function (response) {

      console.log(response)

      $('.campos-duplicados').html('');
      $('.btn-duplica-linha').show();

      if (response.success) {


        if (response.data.length < 2) {
          $('.modal-desenvolver-select-materia-prima').val('').trigger('change');
        }

        // Atualiza os campos do modal com as informações do projeto
        preencherModalComDados(response.data[0]);

        // Matérias Primas
        let numSelects = response.data.length - 1;
        let selectsCriados = $('.modal-visualizar-select-materia-prima').length;

        if (selectsCriados < numSelects) {
          for (let i = selectsCriados; i < numSelects; i++) {
            $('.btn-duplica-linha').last().trigger('click');
          }

          setTimeout(() => {
            $.each(response.data.slice(1), (selectIndex, materiaPrima) => {
              setTimeout(() => {
                $('.modal-visualizar-select-materia-prima').eq(selectIndex).val(materiaPrima.id).trigger('change');
                $('.modal-visualizar-input-percentual').eq(selectIndex).val(formatarPercentual(materiaPrima.PERCENTUAL_MP_PROJETO));
                $('.modal-visualizar-input-quantidade-materia-prima').eq(selectIndex).val(materiaPrima.QUANTIDADE_MP_PROJETO);
                $('.modal-visualizar-input-valor-materia-prima').eq(selectIndex).val(materiaPrima.VALOR_MP_PROJETO);
                $('.modal-visualizar-input-total-materia-prima').eq(selectIndex).val(materiaPrima.TOTAL_MP_PROJETO);
              }, 100);
            });
          }, 500);
        }

        $.each(response.data.slice(1), (selectIndex, materiaPrima) => {
          $('.modal-visualizar-select-materia-prima').eq(selectIndex).val(materiaPrima.id).trigger('change');
          $('.modal-visualizar-input-percentual').eq(selectIndex).val(formatarPercentual(materiaPrima.PERCENTUAL_MP_PROJETO));
          $('.modal-visualizar-input-quantidade-materia-prima').eq(selectIndex).val(materiaPrima.QUANTIDADE_MP_PROJETO);
          $('.modal-visualizar-input-valor-materia-prima').eq(selectIndex).val(materiaPrima.VALOR_MP_PROJETO);
          $('.modal-visualizar-input-total-materia-prima').eq(selectIndex).val(materiaPrima.TOTAL_MP_PROJETO);

        });

        $('.input-sub-total').val(formatarValorMoeda(response.data[0].custo_sub_total_1));




      } else {

        avisoRetorno(response.title, response.message, response.type, '#');
      }
    }
  });

}


