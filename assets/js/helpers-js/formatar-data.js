function formatarDatas(date) {

    let dataInglesa = date.split('-');
    let dataBr = `${dataInglesa[2]}/${dataInglesa[1]}/${dataInglesa[0]}`

    return dataBr;
}

function formatarDatasComHora(dateTime) {
    // Separa a data e a hora
    let [data] = dateTime.split(' ');

    // Formata a data (YYYY-MM-DD para DD/MM/YYYY)
    let dataInglesa = data.split('-');
    let dataBr = `${dataInglesa[2]}/${dataInglesa[1]}/${dataInglesa[0]}`;


    // Retorna a data 
    return `${dataBr}`;
}