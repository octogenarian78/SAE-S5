window.onload = init;
window.onresize = resizeCharts;

let MCForte, MCFaible;

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
}

function diagrammeMonteCarlo() {
    MCForte = echarts.init(document.getElementById('ScalaForteMonte'));
    MCFaible = echarts.init(document.getElementById('ScalaFaibleMonte'));

    fetch('../ressources/fonction/get_data_forte_MC.php')
    .then(response => response.json())
    .then(option => {
        let dates = option.data.xAxis.data;
        let moyennes = option.data.series[0].data;

        let options = {
            title: { 
                text: 'Évolution du SpeedUp \nen fonction du nombre de processus' 
            },
            tooltip: { 
                trigger: 'item' 
            },
            legend: { 
                data: ['Moyennes', 'y = x'],
                textStyle: { 
                    color: 'black'  // La couleur du texte de la légende (vous pouvez la personnaliser si nécessaire)
                }
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
                    lineStyle: { 
                        type: 'dashed',  
                        color: 'red' 
                    }, itemStyle: {
                        color: 'red'  // Applique également la couleur rouge aux points de la courbe
                    }
                }
            ]
        };
        

        MCForte.setOption(options);
    })
    .catch(error => console.error('Erreur lors de la récupération des données :', error));

    fetch('../ressources/fonction/get_data_faible_MC.php')
        .then(response => response.json())
        .then(option => {
            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data;

            let options = {
                title: { 
                    text: 'Évolution des SpeedUp \nen fonction du nombre de points' 
                },
                tooltip: { 
                    trigger: 'item' 
                },
                legend: {
                    data: ['Moyennes', 'y = 1']  // Ajout de 'y = 1' à la légende
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
                        name: 'Courbe de SpeedUp',
                        data: moyennes, 
                        type: 'line' 
                    },
                    { 
                        name: 'Courbe optimal', 
                        data: new Array(dates.length).fill(1),  // Crée une série avec la valeur constante y = 1
                        type: 'line', 
                        lineStyle: { 
                            type: 'dashed',  // Ligne continue
                            color: 'red'    // Courbe y = 1 en rouge
                        },
                        itemStyle: {
                            color: 'red'  // Applique également la couleur rouge aux points de la courbe
                        }
                    }
                ]
            };
            

            MCFaible.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));
        // Redimensionner les graphiques après avoir défini les options
        MCForte.resize();
        MCFaible.resize();
}

function diagrammePrime() {
    PrimeForte = echarts.init(document.getElementById('ScalaFortePrime'));
    PrimeFaible = echarts.init(document.getElementById('ScalaFaiblePrime'));

    fetch('../ressources/fonction/get_data_forte_prime.php')
    .then(response => response.json())
    .then(option => {
        let dates = option.data.xAxis.data;
        let moyennes = option.data.series[0].data;

        let options = {
            title: { 
                text: 'Évolution du SpeedUp \nen fonction du nombre de processus' 
            },
            tooltip: { 
                trigger: 'item' 
            },
            legend: { 
                data: ['Moyennes', 'y = x'],
                textStyle: { 
                    color: 'black'  // La couleur du texte de la légende (vous pouvez la personnaliser si nécessaire)
                }
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
                    lineStyle: { 
                        type: 'dashed',  
                        color: 'red' 
                    }, itemStyle: {
                        color: 'red'  // Applique également la couleur rouge aux points de la courbe
                    }
                }
            ]
        };
        

        PrimeForte.setOption(options);
    })
    .catch(error => console.error('Erreur lors de la récupération des données :', error));

    fetch('../ressources/fonction/get_data_faible_prime.php')
        .then(response => response.json())
        .then(option => {
            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data;

            let options = {
                title: { 
                    text: 'Évolution des SpeedUp \nen fonction du nombre de points' 
                },
                tooltip: { 
                    trigger: 'item' 
                },
                legend: {
                    data: ['Moyennes', 'y = 1']  // Ajout de 'y = 1' à la légende
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
                        name: 'Courbe de SpeedUp',
                        data: moyennes, 
                        type: 'line' 
                    },
                    { 
                        name: 'Courbe optimal', 
                        data: new Array(dates.length).fill(1),  // Crée une série avec la valeur constante y = 1
                        type: 'line', 
                        lineStyle: { 
                            type: 'dashed',  // Ligne continue
                            color: 'red'    // Courbe y = 1 en rouge
                        },
                        itemStyle: {
                            color: 'red'  // Applique également la couleur rouge aux points de la courbe
                        }
                    }
                ]
            };
            

            PrimeFaible.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));
    // Redimensionner les graphiques après avoir défini les options
    PrimeForte.resize();
    PrimeFaible.resize();
}
