$(function () {

    // Máscara para CEP (00000-000)
    $('.mascara-cep').mask('00000-000');

    // Máscara para Placa (AAA-AAAA), permitindo letras e números
    $('.mascara-placa').mask('AAA-AAAA', {
        translation: { 'A': { pattern: /[A-Za-z0-9]/ } }
    });

    $('.mascara-percentual').mask('000,0000');

    $('.mascara-peso').mask('0,000');

    // Valida e formata o valor ao perder o foco
    $('.mascara-peso').on('focusout', function () {
        let valor = $(this).val().replace('.', '').replace(',', '.');
        let valorNumerico = parseFloat(valor);
    
        if (valor === '' || isNaN(valorNumerico)) {
            // Se o campo estiver vazio ou o valor não é numérico, deixa o campo vazio
            $(this).val('');
        } else if (valorNumerico > 1.000) {
            // Se o valor exceder o máximo permitido, define como 1,000 g
            $(this).val('1,000 g');
        } else {
            // Formata o valor para quatro casas decimais e adiciona "g" no final
            $(this).val(valorNumerico.toLocaleString('pt-BR', {
                minimumFractionDigits: 3,
                maximumFractionDigits: 3
            }) + ' g');
        }
    });
    


    $('.mascara-custos').mask('000.000.000,000', {
        reverse: true,
        translation: {
            0: {
                pattern: /[0-9]/,
                optional: true
            }
        }
    }).on('input', function () {
        // Remove pontos enquanto o usuário digita
        let valor = $(this).val().replace(/\./g, ''); // Remove todos os pontos
        $(this).val(valor);
    }).on('focusout', function () {
        let valor = $(this).val().replace('.', '').replace(',', '.'); // Troca vírgula por ponto e remove pontos
        let valorNumerico = parseFloat(valor);

        if (valor === '' || isNaN(valorNumerico)) {
            // Se o campo estiver vazio ou o valor não é numérico, deixa o campo vazio
            $(this).val('');
        } else {
            // Formata o valor para três casas decimais
            $(this).val(valorNumerico.toLocaleString('pt-BR', {
                minimumFractionDigits: 3,
                maximumFractionDigits: 3
            }));
        }
    });

    $('.mascara-fase').mask('A00', {
        translation: {
            'A': { pattern: /[A-Za-z]/, optional: true, recursive: false },
            '0': { pattern: /[0-9]/ }
        },
        onKeyPress: function (value, e, field, options) {
            value = value.toUpperCase();
            $(field).val(value);
        }
    });

    $('.mascara-tempo').mask('00:00:00');

    $('.mascara-tempo').on('focusout', function () {
        let valor = $(this).val().split(':');
    
        
        if (valor.length === 1) {
            valor.push('00', '00'); 
        } else if (valor.length === 2) {
            valor.push('00'); 
        }
    
        
        valor[0] = valor[0].padStart(2, '0'); 
        valor[1] = valor[1].padStart(2, '0'); 
        valor[2] = valor[2].padStart(2, '0'); 
        
        if (parseInt(valor[1]) > 59) {
            valor[1] = '59';
        }
    
        if (parseInt(valor[2]) > 59) {
            valor[2] = '59';
        }
    
        $(this).val(valor.join(':'));
    });
    

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

    $('.mascara-porcentagem').mask('000,00', { // Permitir até 2 casas decimais
        reverse: true
    }).on('focusout', function () {
        let valor = parseFloat($(this).val().replace('.', '').replace(',', '.'));

        if (valor > 100) {
            // Se o valor exceder o máximo permitido, define como 100
            $(this).val('100');
        } else {
            // Formata o valor para manter até 2 casas decimais
            $(this).val(valor.toLocaleString('pt-BR', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2 // Permitir até 2 casas decimais
            }));
        }
    });


});

