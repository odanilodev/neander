function formatarValorMoeda(valor) {
    const numero = parseFloat(valor);

    if (isNaN(numero)) {
        return ''; 
    }

    const numeroArredondado = numero.toFixed(2);

    return parseFloat(numeroArredondado).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}
