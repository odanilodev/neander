function formatarValorMoeda(valor) {
    // Converter o valor para um número
    const numero = parseFloat(valor);

    // Retorna uma string vazia se o número não for válido
    if (isNaN(numero)) {
        return ''; 
    }

    // Formata e retorna o número como moeda
    return numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}