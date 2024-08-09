$(document).ready(function () {

    // Máscara para CEP (00000-000)
    $('.mascara-cep').mask('00000-000');

    // Máscara para Placa (AAA-AAAA), permitindo letras e números
    $('.mascara-placa').mask('AAA-AAAA', {
        translation: { 'A': { pattern: /[A-Za-z0-9]/ } }
    });

    // Máscara para tempo
    $('.mascara-tempo').mask('00:00');

    // Máscara para Telefone (00) 00000-0000
    $('.mascara-tel').mask('(00) 00000-0000');

    // Máscara para CNPJ (00.000.000/0000-00), com reversão para facilitar a entrada
    $('.mascara-cnpj').mask('00.000.000/0000-00', { reverse: true });

    // Máscara para Conta Bancária (00000000000000000000), permitindo números e caracteres específicos
    $('.mascara-conta-bancaria').mask('00000000000000000000', {
        translation: { '0': { pattern: /[0-9/.-]/ } }
    });

    // Máscara para CPF (000.000.000-00), com reversão para facilitar a entrada
    $('.mascara-cpf').mask('000.000.000-00', { reverse: true });

    // Máscara para Dinheiro (000.000.000.000.000,00), com reversão para facilitar a entrada
    $('.mascara-dinheiro').mask('000.000.000.000.000,00', { reverse: true });

    // Máscara para Agência (0000-0 / 00)
    $('.mascara-agencia').mask('0000-0 / 00');

    // Máscara para Data (00/00/0000)
    $('.mascara-data').mask('00/00/0000');

    // Máscara para CAS Registry Number (0000000-00-0), permitindo flexibilidade
    $('.mascara-cas-number').mask('0000000-00-0', {
        translation: {
            '0': { pattern: /[0-9]/, optional: true }
        },
        reverse: true
    });

    // Máscara para INCI (alfanumérico com até 20 caracteres)
    $('.mascara-inci').mask('AAAAAAAAAAAAAAAAAAAA', {
        translation: {
            'A': { pattern: /[a-zA-Z]/ }
        }
    });
});

