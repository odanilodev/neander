var baseUrl = $('.base-url').val();

$(function () {

    // Máscara e validação do CEP
    $('.input-cep').on('blur', function () {
        let cep = $(this).val().replace(/\D/g, '');

        if (cep.length !== 8 && cep.length > 0) {
            avisoRetorno('CEP inválido', 'Verifique se digitou corretamente!', 'error', '#');
            return;
        }

        preencherEnderecoPorCEP(cep, function (retornoViaCep) {
            if (retornoViaCep.erro) {
                avisoRetorno(retornoViaCep.titulo, retornoViaCep.mensagem, retornoViaCep.type, '#');
                return;
            }

            $('#rua').val(retornoViaCep.logradouro);
            $('#bairro').val(retornoViaCep.bairro);
            $('#cidade').val(retornoViaCep.localidade);
            $('#estado').val(retornoViaCep.uf);
        });
    });

    // Inicialização do select2
    $('.select2').select2({
        theme: "bootstrap-5",
        dropdownParent: $('#modalDesenvolverProjeto')
    });

    $('.select2').select2({
        theme: "bootstrap-5"
    });

});

const cadastraProjeto = () => {

    let id = $('.input-id').val();

    let dadosInformacoes = {};
    $('#form-informacoes .campo-informacoes').each(function () {
        // Trata os checkboxes como 0 ou 1
        if ($(this).attr('type') == 'checkbox') {
            dadosInformacoes[$(this).attr('name')] = $(this).is(':checked') ? 1 : 0;
        } else {
            dadosInformacoes[$(this).attr('name')] = $(this).val();
        }
    });

    let dadosBriefing = {};
    $('#form-briefing .campo-briefing').each(function () {
        dadosBriefing[$(this).attr('name')] = $(this).val();
    });

    let dadosCustos = {};
    $('#form-custos .campo-custos').each(function () {
        dadosCustos[$(this).attr('name')] = $(this).val();
    });

    let idCliente = $('.input-id-cliente').val();

    $.ajax({
        type: 'POST',
        url: `${baseUrl}projetos/cadastraProjeto`,
        data: {
            dadosInformacoes: dadosInformacoes,
            dadosBriefing: dadosBriefing,
            dadosCustos: dadosCustos,
            id: id,
            idCliente: idCliente
        },
        beforeSend: function () {
            $('.load-form').removeClass('d-none');
            $('.bnt-voltar').addClass('d-none');
            $('.btn-proximo').addClass('d-none');
        },
        success: function (data) {

            if (data.success) {

                avisoRetorno('Sucesso!', `${data.message}`, 'success', `${baseUrl}/clientes/detalhes/${data.idClienteCadastrado}`);

            } else {

                avisoRetorno('Algo deu errado!', `${data.message}`, 'error', '#');

            }

        }
    });
}

const inativaProjetoCliente = (id, idCliente) => {

    Swal.fire({
        title: 'Você tem certeza?',
        text: "O Cliente será inativado mas seu projeto continuará salvo.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, inativar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'post',
                url: `${baseUrl}projetos/inativaProjetoCliente`,
                data: {
                    id: id
                },
                success: function (data) {
                    let redirect = data.type != 'error' ? `${baseUrl}clientes/detalhes/${idCliente}` : '#';

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

const ativarProjetoCliente = (id, idCliente) => {

    Swal.fire({
        title: 'Você tem certeza?',
        text: "O projeto será reativado para este cliente.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, reativar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'post',
                url: `${baseUrl}projetos/ativarProjetoCliente`,
                data: {
                    id: id
                },
                success: function (data) {
                    let redirect = data.type != 'error' ? `${baseUrl}clientes/detalhes/${idCliente}` : '#';

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


//===============================================


