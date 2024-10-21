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

//================================================

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

//================================================

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

      $('.campos-duplicados-visualizar').html('');

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
            $('.novo-btn-duplicar-linhas').trigger('click');
          }

          setTimeout(() => {
            $.each(response.data.slice(1), (selectIndex, materiaPrima) => {
              setTimeout(() => {
                $('.modal-visualizar-select-materia-prima').eq(selectIndex).val(materiaPrima.ID_MATERIA_PRIMA).trigger('change');
                $('.modal-visualizar-input-percentual').eq(selectIndex).val(formatarPercentual(materiaPrima.PERCENTUAL_MP_PROJETO));
                $('.modal-visualizar-fase').eq(selectIndex).val((materiaPrima.FASE_MATERIA_PRIMA));
                $('.modal-visualizar-input-quantidade-materia-prima').eq(selectIndex).val(materiaPrima.QUANTIDADE_MP_PROJETO);
                $('.modal-visualizar-input-total-materia-prima').eq(selectIndex).val(formatarValorMoeda(materiaPrima.TOTAL_MP_PROJETO));
              }, 100);
            });
          }, 500);
        }

        $.each(response.data.slice(1), (selectIndex, materiaPrima) => {
          $('.modal-visualizar-select-materia-prima').eq(selectIndex).val(materiaPrima.id).trigger('change');
          $('.modal-visualizar-input-percentual').eq(selectIndex).val(formatarPercentual(materiaPrima.PERCENTUAL_MP_PROJETO));
          $('.modal-visualizar-fase').eq(selectIndex).val((materiaPrima.FASE_MATERIA_PRIMA));
          $('.modal-visualizar-input-quantidade-materia-prima').eq(selectIndex).val(materiaPrima.QUANTIDADE_MP_PROJETO);
          $('.modal-visualizar-input-total-materia-prima').eq(selectIndex).val(formatarValorMoeda(materiaPrima.TOTAL_MP_PROJETO));

        });

        $('.select2').attr('disabled', true);

        $('.input-sub-total').val(formatarValorMoeda(response.data[0].custo_sub_total_1));

      } else {

        avisoRetorno(response.title, response.message, response.type, '#');
      }
    }
  });

}

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

$('.novo-btn-duplicar-linhas').on('click', function () {
  duplicarLinhasVisualizar();
  carregaSelect2('select2', 'modalVisualizarDesenvolvimentoProjeto');

})

function duplicarLinhasVisualizar() {
  let optionsMateriaPrima = $('.modal-visualizar-select-materia-prima').html();

  let novaLinha = $(`
      <div class="row mb-2">
          <div class="col-md-4">
              <select name="id_materia_prima" class="form-control select2 modal-visualizar-select-materia-prima">
                  ${optionsMateriaPrima}
              </select>
          </div>
          <div class="col-md-1">
              <input disabled type="text" class="text-1000 mascara-fase form-control input-materia-prima form-control modal-visualizar-fase">
          </div>
          <div class="col-md-2">
              <div class="input-group">
                  <input disabled  type="number" class="text-1000 form-control modal-visualizar-input-percentual">
                  <span class="input-group-text">%</span>
              </div>
          </div>
          <div class="col-md-2">
              <div class="input-group">
                  <input type="text" disabled class=" text-1000 mascara-peso form-control modal-visualizar-input-quantidade-materia-prima">
                  <span class="input-group-text">KG.</span>
              </div>
          </div>
          <div class="col-md-3">
              <input type="text" disabled class="text-1000 form-control modal-visualizar-input-total-materia-prima">
          </div>
      </div>
  `);

  $('.campos-duplicados-visualizar').append(novaLinha);

}

//================================================

function reformularProjeto(projetoId, idCliente) {

 
  Swal.fire({
    title: 'Você tem certeza?',
    text: "Isso irá reformular o projeto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, reformular!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `${baseUrl}projetos/reformularProjeto`,
        type: 'POST',
        data: {
          id: projetoId
        },
        success: function (response) {
          if (response.success) {
            let redirect = response.data.type !== 'error' ? `${baseUrl}clientes/detalhes/${idCliente}` : '#';
            avisoRetorno(`${response.data.title}`, `${response.data.message}`, `${response.data.type}`, redirect);
          } else {
            avisoRetorno(`${response.title}`, `${response.message}`, `${response.type}`, '#');
          }
        },
        error: function (xhr, status, error) {
          Swal.fire(
            'Erro!',
            'Ocorreu um erro: ' + error,
            'error'
          );
        }
      });
    }
  });
}



