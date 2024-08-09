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




