window.onload = init;
window.onresize = resizeCharts;

let MCForte, MCFaible, PrimeForte, PrimeFaible;

function init() {
    diagrammeMonteCarlo();
    diagrammePrime();
    resizeCharts();
}

function resizeCharts() {
    // Redimensionner les graphiques ECharts
    if (MCForte) {
        MCForte.resize();
    }
    if (MCFaible) {
        MCFaible.resize();
    }
    if (PrimeForte) {
        PrimeForte.resize();
    }
    if (PrimeFaible) {
        PrimeFaible.resize();
    }
}

function diagrammeMonteCarlo() {
    MCForte = echarts.init(document.getElementById('ScalaForteMonte'));
    MCFaible = echarts.init(document.getElementById('ScalaFaibleMonte'));

    fetch('../ressources/fonction/get_data_forte_MC.php')
        .then(response => response.json())
        .then(option => {
            console.log(option); // Vérification des données reçues

            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data;

            let options = {
                title: { 
                    text: 'Monte Carlo: Évolution du SpeedUp \nen fonction du nombre de processus' 
                },
                tooltip: { 
                    trigger: 'item' 
                },
                legend: { 
                    data: ['Moyennes', 'y = x'],
                    textStyle: { color: 'black' }
                },
                xAxis: { 
                    type: 'category', 
                    data: dates 
                },
                yAxis: { 
                    type: 'value' 
                },
                series: [ 
                    { 
                        name: 'Courbe de SpeedUP', 
                        data: moyennes, 
                        type: 'line' 
                    },
                    { 
                        name: 'Courbe optimal', 
                        data: dates.map(date => parseFloat(date)), 
                        type: 'line', 
                        lineStyle: { type: 'dashed', color: 'red' }, 
                        itemStyle: { color: 'red' }
                    }
                ]
            };

            MCForte.clear();
            MCForte.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));

    fetch('../ressources/fonction/get_data_faible_MC.php')
        .then(response => response.json())
        .then(option => {
            console.log(option); // Vérification des données reçues

            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data;

            let options = {
                title: { 
                    text: 'Monte Carlo: Évolution des SpeedUp \nen fonction du nombre de points' 
                },
                tooltip: { trigger: 'item' },
                legend: { data: ['Moyennes', 'y = 1'] },
                xAxis: { type: 'category', data: dates },
                yAxis: { type: 'value' },
                series: [
                    { 
                        name: 'Courbe de SpeedUp',
                        data: moyennes, 
                        type: 'line' 
                    },
                    { 
                        name: 'Courbe optimal', 
                        data: new Array(dates.length).fill(1), 
                        type: 'line', 
                        lineStyle: { type: 'dashed', color: 'red' }, 
                        itemStyle: { color: 'red' }
                    }
                ]
            };

            MCFaible.clear();
            MCFaible.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));

    MCForte.resize();
    MCFaible.resize();
}

function diagrammePrime() {
    PrimeForte = echarts.init(document.getElementById('ScalaFortePrime'));
    PrimeFaible = echarts.init(document.getElementById('ScalaFaiblePrime'));

    fetch('../ressources/fonction/get_data_forte_prime.php')
        .then(response => response.json())
        .then(option => {
            console.log(option); // Vérification des données reçues

            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data;

            let options = {
                title: { 
                    text: 'Prime: Évolution du SpeedUp \nen fonction du nombre de processus' 
                },
                tooltip: { trigger: 'item' },
                legend: { 
                    data: ['Moyennes', 'y = x'],
                    textStyle: { color: 'black' }
                },
                xAxis: { type: 'category', data: dates },
                yAxis: { type: 'value' },
                series: [
                    { 
                        name: 'Courbe de SpeedUP', 
                        data: moyennes, 
                        type: 'line' 
                    },
                    { 
                        name: 'Courbe optimal', 
                        data: dates.map(date => parseFloat(date)), 
                        type: 'line', 
                        lineStyle: { type: 'dashed', color: 'red' }, 
                        itemStyle: { color: 'red' }
                    }
                ]
            };

            PrimeForte.clear();
            PrimeForte.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));

    fetch('../ressources/fonction/get_data_faible_prime.php')
        .then(response => response.json())
        .then(option => {
            console.log(option); // Vérification des données reçues

            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data;

            let options = {
                title: { 
                    text: 'Prime: Évolution des SpeedUp \nen fonction du nombre de points' 
                },
                tooltip: { trigger: 'item' },
                legend: { data: ['Moyennes', 'y = 1'] },
                xAxis: { type: 'category', data: dates },
                yAxis: { type: 'value' },
                series: [
                    { 
                        name: 'Courbe de SpeedUp', 
                        data: moyennes, 
                        type: 'line' 
                    },
                    { 
                        name: 'Courbe optimal', 
                        data: new Array(dates.length).fill(1), 
                        type: 'line', 
                        lineStyle: { type: 'dashed', color: 'red' }, 
                        itemStyle: { color: 'red' }
                    }
                ]
            };

            PrimeFaible.clear();
            PrimeFaible.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));

    PrimeForte.resize();
    PrimeFaible.resize();
}
