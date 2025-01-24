window.onload = init;
window.onresize = resizeCharts;

let MCForte, MCFaible, PrimeForte, PrimeFaible, PrimePlusForte, PrimePlusFaible;

function init() {
    diagrammeMonteCarlo();
    diagrammePrime();
    diagrammePrimePlus();
    resizeCharts();
}

function resizeCharts() {
    // Redimensionner les graphiques ECharts
    if (MCForte) MCForte.resize();
    if (MCFaible) MCFaible.resize();
    if (PrimeForte) PrimeForte.resize();
    if (PrimeFaible) PrimeFaible.resize();
    if (PrimePlusForte) PrimePlusForte.resize();
    if (PrimePlusFaible) PrimePlusFaible.resize();
}

function diagrammeMonteCarlo() {
    MCForte = echarts.init(document.getElementById('ScalaForteMonte'));
    MCFaible = echarts.init(document.getElementById('ScalaFaibleMonte'));

    fetch('../ressources/fonction/get_data_forte_MC.php')
        .then(response => response.json())
        .then(option => {
            setChartOptions(MCForte, option, 'Monte Carlo: Évolution du SpeedUp en fonction du nombre de processus');
        })
        .catch(error => console.error('Erreur lors de la récupération des données pour MCForte:', error));

    fetch('../ressources/fonction/get_data_faible_MC.php')
        .then(response => response.json())
        .then(option => {
            setChartOptions(MCFaible, option, 'Monte Carlo: Évolution des SpeedUp en fonction du nombre de points', 1);
        })
        .catch(error => console.error('Erreur lors de la récupération des données pour MCFaible:', error));
}

function diagrammePrime() {
    PrimeForte = echarts.init(document.getElementById('ScalaFortePrime'));
    PrimeFaible = echarts.init(document.getElementById('ScalaFaiblePrime'));

    fetch('../ressources/fonction/get_data_forte_prime.php')
        .then(response => response.json())
        .then(option => {
            setChartOptions(PrimeForte, option, 'Prime: Évolution du SpeedUp en fonction du nombre de processus');
        })
        .catch(error => console.error('Erreur lors de la récupération des données pour PrimeForte:', error));

    fetch('../ressources/fonction/get_data_faible_prime.php')
        .then(response => response.json())
        .then(option => {
            setChartOptions(PrimeFaible, option, 'Prime: Évolution des SpeedUp en fonction du nombre de points', 1);
        })
        .catch(error => console.error('Erreur lors de la récupération des données pour PrimeFaible:', error));
}

function diagrammePrimePlus() {
    PrimePlusForte = echarts.init(document.getElementById('ScalaFortePrimePlus'));
    PrimePlusFaible = echarts.init(document.getElementById('ScalaFaiblePrimePlus'));

    fetch('../ressources/fonction/get_data_forte_prime_plus.php')
        .then(response => response.json())
        .then(option => {
            setChartOptions(PrimePlusForte, option, 'PrimePlus: Évolution du SpeedUp en fonction du nombre de processus');
        })
        .catch(error => console.error('Erreur lors de la récupération des données pour PrimePlusForte:', error));

    fetch('../ressources/fonction/get_data_faible_prime_plus.php')
        .then(response => response.json())
        .then(option => {
            setChartOptions(PrimePlusFaible, option, 'PrimePlus: Évolution des SpeedUp en fonction du nombre de points', 1);
        })
        .catch(error => console.error('Erreur lors de la récupération des données pour PrimePlusFaible:', error));
}

function setChartOptions(chart, option, titleText, idealLineValue = 'x') {


    let dates = option.data.xAxis.data;
    let moyennes = option.data.series[0].data;

    let idealLine = idealLineValue === 1 
        ? new Array(dates.length).fill(1) 
        : dates.map(date => parseFloat(date));

    let options = {
        title: { text: titleText },
        tooltip: { trigger: 'item' },
        legend: { data: ['Moyennes', `y = ${idealLineValue}`], textStyle: { color: 'black' } },
        xAxis: { type: 'category', data: dates },
        yAxis: { type: 'value' },
        series: [
            { name: 'Courbe de SpeedUP', data: moyennes, type: 'line' },
            {
                name: 'Courbe optimale',
                data: idealLine,
                type: 'line',
                lineStyle: { type: 'dashed', color: 'red' },
                itemStyle: { color: 'red' }
            }
        ]
    };

    chart.clear();
    chart.setOption(options);
}
