window.onload = init;

function init() {
    diagrammeMonteCarlo();
}

function resizeContainers() {
    // Cette fonction peut être utilisée pour gérer les redimensionnements de vos containers, si nécessaire.
}

function diagrammeMonteCarlo() {
    let MCForte = echarts.init(document.getElementById('ScalaForteMonte'));

    
    fetch('../ressources/fonction/get_data_forte_MC.php')  
        .then(response => response.json())
        .then(option => {
            let dates = option.data.xAxis.data;
            let moyennes = option.data.series[0].data; 
            
            let options = {
                title: {
                    text: 'Évolution des Moyennes et Points'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    data: ['Moyennes']
                },
                xAxis: {
                    type: 'category',
                    data: dates, // Assurez-vous que 'dates' contient les points distincts ou les valeurs pour l'axe X
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name: 'Moyennes',
                        data: moyennes, // Assurez-vous que 'moyennes' contient les valeurs pour l'axe Y
                        type: 'line',    
                    }
                ]
            };
            

            // Appliquer les options au graphique
            MCForte.setOption(options);
        })
        .catch(error => console.error('Erreur lors de la récupération des données :', error));


        let MCFaible = echarts.init(document.getElementById('ScalaFaibleMonte'));

    
        fetch('../ressources/fonction/get_data_faible_MC.php')  
            .then(response => response.json())
            .then(option => {
                let dates = option.data.xAxis.data;
                let moyennes = option.data.series[0].data; 
                
                let options = {
                    title: {
                        text: 'Évolution des Moyennes et Points'
                    },
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        data: ['Moyennes']
                    },
                    xAxis: {
                        type: 'category',
                        data: dates, // Assurez-vous que 'dates' contient les points distincts ou les valeurs pour l'axe X
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [
                        {
                            name: 'Moyennes',
                            data: moyennes, // Assurez-vous que 'moyennes' contient les valeurs pour l'axe Y
                            type: 'line',    
                        }
                    ]
                };
                
    
                // Appliquer les options au graphique
                MCFaible.setOption(options);
            })
            .catch(error => console.error('Erreur lors de la récupération des données :', error));
}
