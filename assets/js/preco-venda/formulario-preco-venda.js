var baseUrl = $('.base-url').val();

$(function () {

    $('.select2').select2({
        theme: 'bootstrap-5'
    });


    $('#select_cliente').on('change', function () {

        let idCliente = $(this).val();

        $.ajax({
            type: 'post',
            url: `${baseUrl}precoVenda/recebeProjetosCliente`,
            data: {
                idCliente: idCliente,
            },
            success: function (response) {
                if (response.success) {
                    $('#projeto-container').removeClass('d-none');

                    let projetosCliente = '<option value="" selected disabled>Selecione o Projeto</option>';

                    $(response.projeto).each(function (index, projeto) {
                        projetosCliente += `<option value="${projeto.id}">${projeto.nome_marca}</option>`;
                    });

                    $('#select_projetos_cliente').html(projetosCliente);

                } else {
                    avisoRetorno(response.title, response.message, response.type, '#');
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status === 403) {
                    avisoRetorno('Algo deu errado!', 'Você não tem permissão para esta ação.', 'error', '#');
                }
            }
        });
    });

    $('#select_projetos_cliente').on('change', function () {
        $.ajax({
            type:'post',
            
        });
    });

});