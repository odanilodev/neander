var baseUrl = $('.base-url').val();


$(function () {
    $('.select2').select2({
        dropdownParent: $('#modalCadastroMateriaPrima'),
        theme: 'bootstrap-5'
    });
    
});

const cadastraMateriaPrima = () => {
    let formData = new FormData();

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

                avisoRetorno(`${data.title}`, `${data.message}`, `${data.type}`, '#');

                if (data.success) {

                    $('#modalCadastroMateriaPrima').modal('hide');
                    recebeMateriasPrimas();
                    $('.select-fornecedor').val('').trigger('change');

                    $('.select2').select2({
                        dropdownParent: $('#modalDesenvolverProjeto'),
                        theme: 'bootstrap-5',
                    });
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status === 403) {
                    avisoRetorno('Algo deu errado!', `Você não tem permissão para esta ação..`, 'error', '#');
                }
            }
        });
    }
}