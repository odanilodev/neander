var baseUrl = $('.base-url').val();


const cadastraCondicaoPagamento = () => {
  let formData = new FormData();

  formData.append('id', $('.input-id').val());

  formData.append('nomeCondicaoPagamento', $('.input-nome-condicao-pagamento').val());

  // Verificação de campo vazio e permissão para cadastrar
  let permissao = verificaCamposObrigatorios('input-obrigatorio');

  if (permissao) {
    $.ajax({
      type: "post",
      url: `${baseUrl}condicaoPagamento/cadastraCondicaoPagamento`,
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

        let redirect = data.type != 'error' ? `${baseUrl}condicaoPagamento` : '#';
        avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, `${redirect}`);
      },
      error: function (xhr, status, error) {
        if (xhr.status === 403) {
          avisoRetorno('Algo deu errado!', `Você não tem permissão para esta ação..`, 'error', '#');
        }
      }
    });
  }
}

const deletaCondicaoPagamento = (id) => {
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
        url: `${baseUrl}condicaoPagamento/deletaCondicaoPagamento`,
        data: {
          id: id
        },
        success: function (data) {
          let redirect = data.type != 'error' ? `${baseUrl}condicaoPagamento` : '#';

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
