// function formatarValorMoeda(valor) {
//     // Converter o valor para um número
//     const numero = parseFloat(valor);

//     // Retorna uma string vazia se o número não for válido
//     if (isNaN(numero)) {
//         return ''; 
//     }

//     // Formata e retorna o número como moeda
//     return numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
// }

function formatarValorMoeda(valor) {
    // Tenta converter o valor para um número
    const numero = parseFloat(valor);

    // Verifica se o valor é um número válido
    if (isNaN(numero)) {
        return ''; // Retorna uma string vazia se o valor não for numérico
    }

    // Arredonda o número para 3 casas decimais
    const numeroArredondado = numero.toFixed(3);

    // Retorna o valor formatado com 'R$' e substitui '.' por ','
    return 'R$ ' + numeroArredondado.replace('.', ',');
}

const converterParaNumero = (valor) => {
    return parseFloat(valor.replace('R$ ', '').replace(',', '.'));
};

const formatarValor = (valor) => {
    const valorNumerico = parseFloat(valor) || 0;
    return 'R$ ' + valorNumerico.toFixed(2).replace('.', ',');
};

function formatarPercentual(valor) {
    let numero = parseFloat(valor);

    if (numero % 1 === 0) {
        // Se não houver parte decimal, retorna como inteiro
        return numero.toString();
    } else {
        // Se houver parte decimal, retorna com uma casa decimal
        return numero.toFixed(1).replace(/\.0$/, '');
    }
}
