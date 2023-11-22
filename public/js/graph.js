// Obtenemos el canvas del gráfico
var ctx = document.getElementById('demandsChart').getContext('2d');
    
// Creamos la gráfica
var demandsChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            label: 'Tareas registrados',
            data: [],
            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
            borderColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
            borderWidth: 1
        }]
    },
    options: {
        /* scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        } */
    }
});



// Función para filtrar 
function filterDemandsByDate() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
 
    $.ajax({
        url: "/demands-filter",
        type: "GET",
        data: { start_date: start_date, end_date: end_date },
        dataType: "json",
        success: function (data) {
            demandsChart.data.labels = data.labels;
            demandsChart.data.datasets[0].data = data.data;
            demandsChart.update();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

// Llamamos a la función para filtrar 
filterDemandsByDate();
 
// Evento para el botón de filtrado
$('#filter').click(function () {
    filterDemandsByDate();
});