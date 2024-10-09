var baseUrl = $('.base-url').val();

$(function () {
  $('.select2').select2({
    theme: 'bootstrap-5'
  });
});


const cadastraMateriaPrima = () => {
  let formData = new FormData();

  formData.append('id', $('.input-id').val());

  formData.append('nome', $('.input-nome').val());
  formData.append('inci', $('.input-inci').val());
  formData.append('composicao_ptbr', $('.input-composicao-ptbr').val());
  formData.append('idFornecedor', $('.select-fornecedor').val());
  formData.append('valor', $('.input-valor').val());
  formData.append('cas_number', $('.input-cas-number').val());
  formData.append('descricao', $('.input-descricao').val());

  // Verificação de campo vazio e permissão para cadastrar
  let permissao = verificaCamposObrigatorios('input-obrigatorio');

  if (permissao) {
    $.ajax({
      type: "post",
      url: `${baseUrl}materiasPrimas/cadastraMateriaPrima`,
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

        let redirect = data.type != 'error' ? `${baseUrl}materiasPrimas` : '#';
        avisoRetorno(data.title, data.message, data.type, redirect);
      },
      error: function (xhr, status, error) {
        if (xhr.status === 403) {
          avisoRetorno('Algo deu errado!', `Você não tem permissão para esta ação..`, 'error', '#');
        }
      }
    });
  }
}


const deletaMateriaPrima = (id) => {
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
        url: `${baseUrl}materiasPrimas/deletaMateriaPrima`,
        data: {
          id: id
        },
        success: function (data) {
          let redirect = data.type != 'error' ? `${baseUrl}materiasPrimas` : '#';

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